<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleItemAddon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('items')->orderBy('created_at', 'desc')->get();
        
        return view('transaksi.index', compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            // Ambil tanggal hari ini
            $today = Carbon::today();

            $latestSale = Sale::whereDate('created_at', $today)

            ->orderBy('id', 'desc')
            ->first();
            if ($latestSale) {
                // Ambil 4 digit terakhir dari invoice terakhir (misalnya INV-0003 → 3)
                $lastNumber = intval(substr($latestSale->invoice_number, -4));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada transaksi hari ini, mulai dari 0001
                $newNumber = '0001';
            }

            // Buat invoice unik
            $invoiceNumber = 'INV-' . $newNumber;
            
            // Simpan transaksi utama
            $sale = Sale::create([
                'invoice_number' => $invoiceNumber,
                // 'user_id' => Auth::id() ?? 1,
                'total' => $data['total'],
                'payment' => $data['payment'],
                'change_return' => $data['change_return'],
                'sale_date' => Carbon::now(),
            ]);

            // Simpan item
            foreach ($data['cart'] as $item) {
                $saleItem = SaleItem::create([
                    'sale_id' => $sale->id,
                    'menu_id' => $item['id'],
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
    }

    /**
     * Display the specified resource.
     */
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
                return [
                    'name' => $addon->addon->name,
                    'price' => $addon->price_at_sale
                ];
            }),
        ];
    });

    return response()->json([
        'invoice' => $sale->invoice_number,
        'total' => $sale->total,
        'items' => $details,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        return response()->json($sale);
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari transaksi berdasarkan ID
            $sale = Sale::with('items.addons')->findOrFail($id);

            // Hapus relasi addons terlebih dahulu
            foreach ($sale->items as $item) {
                $item->addons()->delete();
            }

            // Hapus semua item dari transaksi
            $sale->items()->delete();

            // Hapus transaksi utama
            $sale->delete();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

}
