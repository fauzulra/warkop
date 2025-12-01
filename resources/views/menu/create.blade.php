@extends('layout.app')
@section('title', 'Tambah Menu')
@section('page-title', 'Tambah Menu')
@section('content')
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Tambah Menu Baru</h2>
                            <p class="mt-1 text-gray-600">Buat menu baru dengan menentukan bahan-bahan dari inventaris</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('menu.index') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6">
        <form action="
        {{ route('menu.store') }}
        " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Form Input Menu -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Menu</h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Nama Menu -->
                            <div>
                                <label for="nama_menu" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Menu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama_menu" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan nama menu">
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Menu
                                </label>
                                <textarea id="deskripsi" name="description" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Deskripsi singkat tentang menu"></textarea>
                            </div>
                            <!-- Harga & Waktu -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">
                                        Harga Jual <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                                        <input type="number" id="harga" name="price" required
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                            placeholder="0">
                                    </div>
                                </div>
                                <div>
                                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kategori Menu <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kategori" name="category" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                        <option value="">Pilih Kategori</option>
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                        <option value="snack">Snack</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Upload Gambar -->
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                                    Gambar Menu
                                </label>
                                <div id="uploadWrapper" class="flex items-center justify-center w-full">
                                    <!-- Kotak Upload -->
                                    <label id="uploadBox" for="imageInput"
                                        class="w-64 h-40 flex flex-col items-center justify-center border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                                                                                                                                        5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5
                                                                                                                                        5a4 4 0 0 0 0 8h2.167">
                                                </path>
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M10 15V6m0 0L8 8m2-2 2 2"></path>
                                            </svg>
                                            <p class="text-sm text-gray-500">Klik untuk upload atau drag and drop</p>
                                            <p class="text-xs text-gray-400">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                        </div>
                                        <input id="imageInput" name="image" type="file" class="hidden"
                                            accept="image/*">
                                    </label>

                                    <!-- Preview Image -->
                                    <div id="previewBox" class="hidden">
                                        <img id="previewImage" src="" alt="Preview"
                                            class="w-64 h-40 object-cover rounded-lg border">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Bahan-Bahan -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-6">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Bahan-Bahan Menu</h3>
                                <button type="button" id="tambahBahan"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah Bahan
                                </button>
                            </div>
                        </div>

                        <div class="p-6">
                            <div id="daftarBahan" class="space-y-4">
                                <!-- Template Bahan (akan di-clone dengan JavaScript) -->
                                <div class="bahan-item border border-gray-200 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Pilih Bahan <span class="text-red-500">*</span>
                                            </label>
                                            <select name="bahan_id[]" required
                                                class="bahan-select w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                                <option value="">Pilih bahan dari inventaris</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-stok="{{ $product->stock }}"
                                                        data-satuan="{{ $product->category }}"
                                                        data-price="{{ $product->unit_price }}">
                                                        {{ $product->name }} (Stok: {{ $product->stock }}
                                                        {{ $product->category }})
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Jumlah <span class="text-red-500">*</span>
                                            </label>
                                            <input type="number" name="quantity[]"min="1" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                                placeholder="0">
                                        </div>
                                        <div class="flex items-end">
                                            <button type="button"
                                                class="hapus-bahan w-full bg-red-100 hover:bg-red-200 text-red-700 px-4 py-3 rounded-lg transition duration-300">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="stok-info text-sm text-gray-600 hidden">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            <span class="stok-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="emptyState" class="text-center py-8 text-gray-500 hidden">
                                <i class="fas fa-plus-circle text-4xl mb-3"></i>
                                <p>Belum ada bahan yang ditambahkan</p>
                                <p class="text-sm">Klik tombol "Tambah Bahan" untuk menambah bahan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Ringkasan</h3>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Total Bahan:</span>
                                <span id="totalBahan" class="font-semibold">0</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Estimasi Biaya Bahan:</span>
                                <span id="estimasiBiaya" class="font-semibold text-green-600">Rp 0</span>
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center text-lg">
                                    <span class="font-semibold">Harga Jual:</span>
                                    <span id="hargaJualRingkasan" class="font-bold text-blue-600">Rp 0</span>
                                </div>
                            </div>

                            <div class="border-t pt-4 space-y-3">
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Menu
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-blue-50 rounded-xl border border-blue-200 p-6 mt-6">
                        <h4 class="font-semibold text-blue-900 mb-3">
                            <i class="fas fa-lightbulb mr-2"></i>
                            Tips
                        </h4>
                        <ul class="text-sm text-blue-800 space-y-2">
                            <li>• Pastikan stok bahan mencukupi</li>
                            <li>• Hitung estimasi biaya dengan tepat</li>
                            <li>• Upload gambar yang menarik</li>
                            <li>• Beri deskripsi yang jelas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaJualInput = document.querySelector('input[name="price"]');
            const bahanContainer = document.getElementById('daftarBahan');
            const totalBahanEl = document.getElementById('totalBahan');
            const estimasiBiayaEl = document.getElementById('estimasiBiaya');
            const hargaJualEl = document.getElementById('hargaJualRingkasan');
            const imageInput = document.getElementById('gambar');

            // Format Rupiah
            function formatRupiah(value) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value || 0);
            }

            // Ambil harga dari option yang dipilih (data-price)
            function getOptionPrice(selectEl) {
                if (!selectEl) return 0;
                const opt = selectEl.options[selectEl.selectedIndex];
                return Number(opt?.dataset?.price ?? 0);
            }

            // Tambah Bahan
            document.getElementById('tambahBahan').addEventListener('click', function() {
                const container = document.getElementById('daftarBahan');
                const template = container.querySelector(
                    '.bahan-item'); // ambil bahan pertama sebagai template
                if (!template) return;

                // clone node
                const newItem = template.cloneNode(true);

                // reset value input/select di clone
                newItem.querySelectorAll('input').forEach(input => input.value = '');
                newItem.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
                newItem.querySelector('.stok-info')?.classList.add('hidden');

                // tambahkan ke daftar
                container.appendChild(newItem);

                // update ringkasan
                updateRingkasan();
            });

            // Hapus Bahan (delegasi event karena clone baru juga butuh listener)
            document.getElementById('daftarBahan').addEventListener('click', function(e) {
                if (e.target.closest('.hapus-bahan')) {
                    const item = e.target.closest('.bahan-item');
                    if (item && document.querySelectorAll('.bahan-item').length > 1) {
                        item.remove();
                        updateRingkasan();
                    }
                }
            });


            // Hitung dan update ringkasan
            function updateRingkasan() {
                const items = bahanContainer.querySelectorAll('.bahan-item');
                const totalBahan = items.length;
                let estimasiBiaya = 0;

                items.forEach(item => {
                    const select = item.querySelector('.bahan-select');
                    const qtyInput = item.querySelector('input[name="quantity[]"]');
                    const qty = parseFloat(qtyInput?.value) || 0;
                    const price = getOptionPrice(select);

                    if (price && qty) {
                        estimasiBiaya += price * qty;
                    }
                });

                const hargaJual = parseFloat(hargaJualInput?.value) || 0;

                totalBahanEl.textContent = totalBahan;
                estimasiBiayaEl.textContent = formatRupiah(estimasiBiaya);
                hargaJualEl.textContent = formatRupiah(hargaJual);
            }

            // Event delegation: input quantity dan perubahan select
            bahanContainer.addEventListener('input', function(e) {
                if (e.target.matches('input[name="quantity[]"]')) {
                    updateRingkasan();
                }
            });

            bahanContainer.addEventListener('change', function(e) {
                if (e.target.matches('.bahan-select')) {
                    // optional: tampilkan info stok jika ada (jika kamu punya elemen stok)
                    const select = e.target;
                    const selectedOpt = select.options[select.selectedIndex];
                    const stok = selectedOpt?.dataset?.stok;
                    const satuan = selectedOpt?.dataset?.satuan;
                    const stokInfo = select.closest('.bahan-item')?.querySelector('.stok-info');
                    const stokText = select.closest('.bahan-item')?.querySelector('.stok-text');

                    if (stokInfo && stokText) {
                        if (selectedOpt.value) {
                            stokText.textContent = `Stok tersedia: ${stok ?? 0} ${satuan ?? ''}`;
                            stokInfo.classList.remove('hidden');
                            // warna berdasarkan stok
                            if ((Number(stok) || 0) === 0) {
                                stokInfo.className = 'stok-info text-sm text-red-600';
                            } else if ((Number(stok) || 0) <= 10) {
                                stokInfo.className = 'stok-info text-sm text-yellow-600';
                            } else {
                                stokInfo.className = 'stok-info text-sm text-green-600';
                            }
                        } else {
                            stokInfo.classList.add('hidden');
                        }
                    }

                    updateRingkasan();
                }
            });

            // Harga jual diinput
            if (hargaJualInput) {
                hargaJualInput.addEventListener('input', updateRingkasan);
            }

            // Preview gambar
            document.getElementById('imageInput').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Sembunyikan kotak upload
                        document.getElementById('uploadBox').classList.add('hidden');
                        // Tampilkan preview
                        document.getElementById('previewBox').classList.remove('hidden');
                        document.getElementById('previewImage').src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Inisialisasi awal (jika ada nilai default)
            updateRingkasan();
        });
    </script>



@endsection
