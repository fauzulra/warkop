<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleItemAddon;
use App\Models\Menu;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();

        // Mengambil data untuk tabel
        $sales = Sale::with('items')->orderBy('created_at', 'desc')->get();

        // Menghitung statistik hari ini
        $totalTransaksi = Sale::whereDate('created_at', $today)->count();
        $selesai = Sale::whereDate('created_at', $today)->where('status', 'selesai')->count();
        $ongoing = Sale::whereDate('created_at', $today)->where('status', 'ongoing')->count();
        $totalPendapatan = Sale::whereDate('created_at', $today)->sum('total');

        return view('transaksi.index', compact('sales', 'totalTransaksi', 'selesai', 'ongoing', 'totalPendapatan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:ongoing,selesai,dibatalkan',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->status = $request->status;
        $sale->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diupdate!');
    }

    public function editOrder($id)
    {
        $sale = Sale::with(['items.menu', 'items.addons.addon'])->findOrFail($id);
        session(['editing_sale_id' => $sale->id]);
        return redirect()->route('menu.index');
    }

    public function updateOrder(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            try {
                $data = $request->validate([
                    'cart' => 'required|array',
                    'cart.*.id' => 'required|integer',
                    'cart.*.quantity' => 'required|integer',
                    'cart.*.price' => 'required|integer',
                    'cart.*.subtotal' => 'required|integer',
                    'cart.*.addons' => 'array',
                    'cart.*.note' => 'nullable|string',
                    'payment' => 'required|integer',
                    'total' => 'required|integer',
                    'change_return' => 'required|integer',
                ]);

                $sale = Sale::with('items.menu.menuIngredients', 'items.addons')->findOrFail($id);

                // 1. Kembalikan stok dari item lama
                foreach ($sale->items as $item) {
                    if ($item->menu) {
                        foreach ($item->menu->menuIngredients as $ingredient) {
                            $product = Product::find($ingredient->product_id);
                            if ($product) {
                                $product->increment('stock', $ingredient->quantity * $item->quantity);
                            }
                        }
                    }
                    $item->addons()->delete();
                }
                $sale->items()->delete();

                foreach ($data['cart'] as $item) {
                    $menu = Menu::with('menuIngredients')->findOrFail($item['id']);

                    foreach ($menu->menuIngredients as $ingredient) {
                        $product = Product::findOrFail($ingredient->product_id);
                        $deduction = $ingredient->quantity * $item['quantity'];

                        if ($product->stock < $deduction) {
                            throw new \Exception("Stok {$product->name} tidak cukup untuk menu {$menu->name}");
                        }
                        $product->decrement('stock', $deduction);
                    }

                    $saleItem = SaleItem::create([
                        'sale_id' => $sale->id,
                        'menu_id' => $menu->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                        'note' => $item['note'] ?? null,
                    ]);

                    if (!empty($item['addons'])) {
                        foreach ($item['addons'] as $addon) {
                            SaleItemAddon::create([
                                'sale_item_id' => $saleItem->id,
                                'addon_id' => $addon['id'],
                                'price_at_sale' => $addon['price'],
                            ]);
                        }
                    }
                }

                // 3. Update data transaksi utama
                $sale->update([
                    'total' => $data['total'],
                    'payment' => $data['payment'],
                    'change_return' => $data['change_return'],
                ]);

                session()->forget('editing_sale_id');

                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi berhasil diperbarui',
                    'invoice_number' => $sale->invoice_number,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }
        });
    }

    public function cancelEdit()
    {
        session()->forget('editing_sale_id');
        return response()->json(['success' => true]);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function newOrder()
    {
        session()->forget('editing_sale_id');
        return redirect()->route('menu.index');
    }
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $data = $request->validate([
                    'cart' => 'required|array',
                    'cart.*.id' => 'required|integer',
                    'cart.*.quantity' => 'required|integer',
                    'cart.*.price' => 'required|integer',
                    'cart.*.subtotal' => 'required|integer',
                    'cart.*.addons' => 'array',
                    'cart.*.note' => 'nullable|string',
                    'payment' => 'required|integer',
                    'total' => 'required|integer',
                    'change_return' => 'required|integer',
                ]);

                $today = Carbon::today();
            
                $latestInvoice = Sale::whereDate('created_at', $today)
                    ->orderByRaw('CAST(SUBSTRING(invoice_number, 5) AS UNSIGNED) DESC')
                    ->first();
                
                $newNumber = $latestInvoice ? str_pad(intval(substr($latestInvoice->invoice_number, 5)) + 1, 4, '0', STR_PAD_LEFT) : '0001';
                $invoiceNumber = 'INV-' . $newNumber;

                // 1. Simpan Transaksi Utama
                $sale = Sale::create([
                    'invoice_number' => $invoiceNumber,
                    'total' => $data['total'],
                    'payment' => $data['payment'],
                    'change_return' => $data['change_return'],
                    'status' => 'ongoing',
                    'sale_date' => Carbon::now(),
                ]);

                // 2. Simpan Item & Kurangi Stok
                foreach ($data['cart'] as $item) {
                    $menu = Menu::with('menuIngredients')->findOrFail($item['id']);

                    // Kurangi stok bahan baku (ingredients)
                    foreach ($menu->menuIngredients as $ingredient) {
                        $product = Product::findOrFail($ingredient->product_id);
                        $deduction = $ingredient->quantity * $item['quantity'];

                        if ($product->stock < $deduction) {
                            throw new \Exception("Stok {$product->name} tidak cukup untuk menu {$menu->name}");
                        }
                        $product->decrement('stock', $deduction);
                    }

                    $saleItem = SaleItem::create([
                        'sale_id' => $sale->id,
                        'menu_id' => $menu->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                        'note' => $item['note'] ?? null,
                    ]);

                    if (!empty($item['addons'])) {
                        foreach ($item['addons'] as $addon) {
                            SaleItemAddon::create([
                                'sale_item_id' => $saleItem->id,
                                'addon_id' => $addon['id'],
                                'price_at_sale' => $addon['price'],
                            ]);
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi berhasil disimpan',
                    'invoice_number' => $invoiceNumber,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }
        });
    }

    public function printReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate   = Carbon::parse($request->end_date)->endOfDay();

        // Ambil data transaksi beserta relasi item dan menunya
        $sales = Sale::with(['items.menu'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung grand total khusus untuk transaksi yang "selesai"
        $totalPendapatan = $sales->where('status', 'selesai')->sum('total');

        return view('transaksi.print', compact('sales', 'startDate', 'endDate', 'totalPendapatan'));
    }

    public function show($id)
    {
        $sale = Sale::with(['items.menu', 'items.addons.addon'])->findOrFail($id);
        $details = $sale->items->map(function ($item) {
            return [
                'menu_name' => $item->menu->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'note' => $item->note,
                'addons' => $item->addons->map(function ($addon) {
                    return ['name' => $addon->addon->name, 'price' => $addon->price_at_sale];
                }),
            ];
        });

        return response()->json(['invoice' => $sale->invoice_number, 'total' => $sale->total, 'items' => $details]);
    }

    public function edit($id)
    {
        return response()->json(Sale::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->update([
            'customer_name' => $request->customer_name,
            'total' => $request->total,
            'note' => $request->note,
        ]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                $sale = Sale::with('items.menu.menuIngredients', 'items.addons')->findOrFail($id);

                // Kembalikan stok barang
                foreach ($sale->items as $item) {
                    if ($item->menu) {
                        foreach ($item->menu->menuIngredients as $ingredient) {
                            $product = Product::find($ingredient->product_id);
                            if ($product) {
                                $product->increment('stock', $ingredient->quantity * $item->quantity);
                            }
                        }
                    }
                    $item->addons()->delete();
                }

                $sale->items()->delete();
                $sale->delete();

                return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus: ' . $e->getMessage()], 500);
            }
        });
    }
}