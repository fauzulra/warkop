<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Menu;
use App\Models\MenuIngredient;
use App\Models\Product;
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

        return view('menu.index', compact('menuItems', 'addons'));
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
            'quantity'      => 'required|array',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
