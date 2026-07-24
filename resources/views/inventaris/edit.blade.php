@extends('layout.app')
@section('title', 'Edit Data Stok Barang')
@section('page-title', 'Edit Data Stok Barang')
@section('content')
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('inventaris.index') }}"
                                class="text-gray-600 hover:text-gray-900 transition duration-200">
                                <i class="fas fa-arrow-left text-lg"></i>
                            </a>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Edit Item</h2>
                                <p class="text-sm text-gray-500 mt-1">Perbarui data item Stok Barang</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button" id="resetForm"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-300 flex items-center font-medium hover:shadow-md">
                                <i class="fas fa-redo mr-2"></i>
                                Reset Form
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form id="inventarisForm" action="{{ route('inventaris.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div>
                                <label for="nama_item" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Item <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="text" id="nama_item" name="name"
                                        value="{{ old('name', $product->name) }}" required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori" name="category" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-white">
                                    <option value="">Pilih Kategori</option>
                                    <option value="makanan"
                                        {{ old('category', $product->category) == 'makanan' ? 'selected' : '' }}>Makanan
                                    </option>
                                    <option value="minuman"
                                        {{ old('category', $product->category) == 'minuman' ? 'selected' : '' }}>Minuman
                                    </option>
                                    <option value="operasional"
                                        {{ old('category', $product->category) == 'operasional' ? 'selected' : '' }}>
                                        Perlengkapan Operasional</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Stok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-boxes text-gray-400"></i>
                                    </div>
                                    <input type="number" id="stok" name="stock" min="0"
                                        value="{{ old('stock', $product->stock) }}" required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="harga_satuan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Satuan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-dollar-sign text-gray-400"></i>
                                    </div>
                                    <input type="text" id="harga_satuan" name="unit_price"
                                        value="{{ old('unit_price', number_format($product->unit_price, 0, ',', '.')) }}"
                                        required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('inventaris.index') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300 flex items-center font-medium">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300 flex items-center font-medium hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i>
                                Update Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hargaInput = document.getElementById("harga_satuan");

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            hargaInput.addEventListener("input", function(e) {
                let value = this.value.replace(/\D/g, "");
                this.value = value ? formatRupiah(value) : "";
            });
        });
    </script>
@endsection
