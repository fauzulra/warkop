<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InvetarisController extends Controller
{
    
    public function index()
    {
    $products = Product::latest()->paginate(10);
    return view('inventaris.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventaris.create');
    }

    public function printReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
        $endDate   = \Carbon\Carbon::parse($request->end_date)->endOfDay();

        // Ambil data produk yang diupdate/dibuat di antara rentang waktu filter
        $products = Product::whereBetween('updated_at', [$startDate, $endDate])
            ->orderBy('category', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('inventaris.print', compact('products', 'startDate', 'endDate'));
    }

    public function newOrder()
    {
        session()->forget('editing_sale_id');
        return redirect()->route('menu.index');
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Bersihkan harga supaya hanya angka
        $cleanPrice = preg_replace('/\D/', '', $request->unit_price);

        // Cek apakah produk dengan nama yang sama sudah ada
        $existingProduct = Product::where('name', $request->name)->first();

        if ($existingProduct) {
            // update stok + harga
            $existingProduct->update([
                'stock'      => $existingProduct->stock + $request->stock,
                'unit_price' => $cleanPrice, 
            ]);

            return redirect()->route('inventaris.index')
                            ->with('success', 'Produk berhasil diupdate!');
        }

        // Generate SKU baru
        $lastProduct = Product::select('sku_code')
        ->orderByRaw('CAST(SUBSTRING(sku_code, 4) AS UNSIGNED) DESC')
        ->first();

    $nextNumber = $lastProduct ? ((int) substr($lastProduct->sku_code, 3)) + 1 : 1;
    $skuCode = 'ITM' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Simpan produk baru
        Product::create([
            'user_id'    => auth()->id(),
            'sku_code'   => $skuCode,
            'name'       => $request->name,
            'category'   => $request->category,
            'stock'      => $request->stock,
            'unit_price' => $cleanPrice, 
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Produk berhasil ditambahkan!');
    }



    public function check(Request $request)
    {
        $product = Product::where('name', $request->name)->first();

        if ($product) {
            return response()->json([
                'exists' => true,
                'category' => $product->category,
                'unit_price' => $product->unit_price,
            ]);
        }

        return response()->json(['exists' => false]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('inventaris.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // pastikan hanya angka murni yang disimpan
    $unitPrice = preg_replace('/\D/', '', $request->unit_price);

    $product->update([
        'name'       => $request->name,
        'category'   => $request->category,
        'stock'      => $request->stock,
        'unit_price' => $unitPrice, // simpan angka bersih
    ]);

    return redirect()->route('inventaris.index')->with('success', 'Produk berhasil diupdate!');
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('inventaris.index')
                        ->with('success', 'Produk berhasil dihapus!');
    }

}
