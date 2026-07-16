<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Menu;
use App\Models\MenuIngredient;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = Menu::all();
        $addons = Addon::all()->groupBy('category')->map(function ($addons) {
            return $addons->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => $addon->name,
                    'price' => $addon->price,
                ];
            });
        });

        // Ambil data produk untuk dropdown "Pilih Bahan" di modal Edit
        $products = Product::all();

        // TAMBAHAN: Cek apakah sedang dalam mode edit transaksi
        $editingSale = null;
        if (session()->has('editing_sale_id')) {
            $sale = Sale::with(['items.menu', 'items.addons.addon'])
                ->find(session('editing_sale_id'));

            if ($sale) {
                $editingSale = [
                    'id' => $sale->id,
                    'invoice_number' => $sale->invoice_number,
                    'items' => $sale->items->map(function ($item) {
                        return [
                            'menuId' => $item->menu_id,
                            'name' => $item->menu->name ?? '-',
                            'basePrice' => (int) $item->price,
                            'quantity' => $item->quantity,
                            'note' => $item->note,
                            'category' => $item->menu->category ?? '',
                            'addOns' => $item->addons->map(function ($a) {
                                return [
                                    'id' => $a->addon_id,
                                    'name' => $a->addon->name ?? '',
                                    'price' => (int) $a->price_at_sale,
                                ];
                            }),
                        ];
                    }),
                ];
            }
        }

        return view('menu.index', compact('menuItems', 'addons', 'products', 'editingSale'));
    }

    /**
     * Mengambil data menu beserta bahannya untuk Modal Edit via AJAX.
     */
    public function getJsonData($id)
    {
        // Pastikan relasi menuIngredients sudah benar penulisannya
        $menu = Menu::with('menuIngredients')->findOrFail($id);
        return response()->json($menu);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $products = Product::all(); // ambil semua produk
        return view('menu.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'bahan_id'    => 'required|array',
            'quantity'    => 'required|array',
        ]);

        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        $menu = Menu::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath, // sesuaikan kalau pakai upload file
            'is_active'   => 1,
        ]);

        // 2. Loop hanya untuk ingredients
        if ($request->bahan_id) {
            foreach ($request->bahan_id as $index => $productId) {
                if ($productId) {
                    MenuIngredient::create([
                        'menu_id'    => $menu->id,              // pake menu yang sudah dibuat
                        'product_id' => $productId,
                        'quantity'   => $request->quantity[$index] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tidak diperlukan jika edit menggunakan Modal
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Ubah bahan_id dan quantity menjadi nullable
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'bahan_id'    => 'nullable|array', 
            'quantity'    => 'nullable|array',
        ]);

        $menu = Menu::findOrFail($id);

        // Update data teks
        $data = [
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
        ];

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('menu_images', 'public');
        }

        // Update data menu ke database
        $menu->update($data);

        // Update Bahan-bahan (Hapus yang lama terlebih dahulu)
        MenuIngredient::where('menu_id', $menu->id)->delete();

        // Cek apakah ada bahan yang dikirim (tidak null)
        if ($request->has('bahan_id') && is_array($request->bahan_id)) {
            foreach ($request->bahan_id as $index => $productId) {
                if ($productId) {
                    MenuIngredient::create([
                        'menu_id'    => $menu->id,
                        'product_id' => $productId,
                        'quantity'   => $request->quantity[$index] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus relasi ingredients
        MenuIngredient::where('menu_id', $menu->id)->delete();

        // Hapus file gambar jika ada
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        // Hapus menu
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}