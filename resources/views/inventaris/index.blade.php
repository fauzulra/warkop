@extends('layout.app')
@section('title', 'Data Stok')
@section('page-title', 'Data Stok')
@section('styles')
    <style>
        /* Menambahkan cursor pointer pada header tabel agar terlihat bisa diklik */
        th {
            cursor: pointer;
            user-select: none;
            /* Mencegah teks terseleksi saat diklik */
        }
    </style>
@endsection
@section('content')
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class=" overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col xl:flex-row gap-6">
                        <!-- Left Side: Filter & Search Controls -->
                        <div class="flex-1">
                            <div class="space-y-4">
                                <!-- Search Input -->
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" id="searchInput"
                                        class="block w-full pl-10 pr-3 py-3  border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                        placeholder="Cari nama item, kode, atau kategori...">
                                </div>
                                <!-- Filter Controls Row -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Category Filter -->
                                    <div>
                                        <select
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-white"
                                            id="categoryFilter">
                                            <option value="">Semua Kategori</option>
                                            <option value="makanan">Makanan</option>
                                            <option value="minuman">Minuman</option>
                                            <option value="perlengkapan">Perlengkapan Operasional</option>
                                        </select>
                                    </div>

                                    <!-- Status Filter -->
                                    <div>
                                        <select
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-white"
                                            id="statusFilter">
                                            <option value="">Semua Status</option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="stok-rendah">Stok Rendah</option>
                                            <option value="habis">Habis</option>
                                        </select>
                                    </div>

                                    <!-- Reset Button -->
                                    <div class="sm:col-span-2 lg:col-span-1">
                                        <button
                                            class="w-full px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-300 flex items-center justify-center hover:shadow-xl transform hover:-translate-y-0.5"
                                            id="resetFilterBtn" type="button">
                                            <i class="fas fa-redo mr-2"></i>
                                            Reset Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Tambah dan Print  --}}
                        <div class="xl:w-[200px] flex flex-col justify-center">
                            <div class="space-y-3">
                                <a href="{{ route('inventaris.create') }}">
                                    <button
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg  flex items-center justify-center font-medium hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Item
                                    </button>
                                </a>

                                @role('admin')
                                    <button type="button" onclick="openPrintModal()"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center justify-center font-medium hover:shadow-xl transform hover:-translate-y-0.5">
                                        <i class="fas fa-download mr-2"></i>
                                        Export Data
                                    </button>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-4">
        <!-- Inventory Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="inventoryTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Kode Item <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Nama Item <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Kategori <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Stok <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Harga <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Terakhir Update
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                    {{ $product->sku_code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ ucwords($product->name) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                @if ($product->category == 'makanan') bg-purple-100 text-purple-800 
                                @elseif($product->category == 'minuman') bg-indigo-100 text-indigo-800
                                @else bg-green-100 text-green-800 @endif">
                                        {{ ucfirst($product->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($product->unit_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($product->stock > 10)
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-circle text-green-400 mr-1 text-xs"></i>
                                            Tersedia
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-triangle text-yellow-400 mr-1 text-xs"></i>
                                            Stok Rendah
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle text-red-400 mr-1 text-xs"></i>
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <!-- Tombol Riwayat Baru -->
                                        <button type="button"
                                            onclick="openHistoryModal('{{ $product->id }}', '{{ $product->name }}')"
                                            class="text-teal-600 hover:text-teal-900" title="Riwayat Pemakaian">
                                            <i class="fas fa-history"></i>
                                        </button>

                                        <a href="{{ route('inventaris.edit', $product->id) }}"
                                            class="text-blue-600 hover:text-blue-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="deleteForm-{{ $product->id }}"
                                            action="{{ route('inventaris.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="openDeleteModal('{{ $product->id }}')"
                                                class="text-red-600 hover:text-red-900" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal Riwayat Pemakaian -->
    <div id="historyModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-2xl relative max-h-[90vh] flex flex-col">
            <!-- Header Modal -->
            <div class="flex items-center justify-between mb-4 border-b pb-4">
                <h3 class="text-lg font-bold text-gray-800">
                    Riwayat Pemakaian: <span id="historyItemName" class="text-blue-600"></span>
                </h3>

                <div class="flex items-center space-x-3">
                    <!-- Tambahan Filter Sort -->
                    <select id="historySort" onchange="renderHistoryTable()"
                        class="px-3 pr-8 py-1.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
                        <option value="desc">Paling Baru</option>
                        <option value="asc">Paling Lama</option>
                    </select>

                    <!-- Tombol Close (Silang) -->
                    <button type="button" onclick="closeHistoryModal()"
                        class="text-gray-400 hover:text-red-500 bg-gray-100 hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Tabel Riwayat -->
            <div class="overflow-y-auto flex-1">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Dibuat</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Invoice</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Menu Terkait</th>
                                    <th
                                        class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Terpakai</th>
                                    <th
                                        class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok Akhir</th>
                                </tr>
                            </thead>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody" class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>

                <!-- Indikator Loading & Kosong -->
                <div id="historyLoading" class="hidden py-8 text-center text-gray-500">
                    <i class="fas fa-spinner fa-spin mr-2 text-blue-500"></i> Memuat data...
                </div>
                <div id="historyEmpty" class="hidden py-8 text-center text-gray-500">
                    Belum ada riwayat pemakaian untuk item ini.
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-4 pt-4 border-t flex justify-end">
                <button type="button" onclick="closeHistoryModal()"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-200 transition duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Cetak Laporan Inventaris -->
    <div id="printModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md relative">
            <!-- Header Modal -->
            <div class="flex items-center justify-between mb-4 border-b pb-4">
                <h3 class="text-lg font-bold text-gray-800">Cetak Laporan Stok</h3>
                <button type="button" onclick="closePrintModal()"
                    class="text-gray-400 hover:text-red-500 bg-gray-100 hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Form Filter -->
            <form action="{{ route('inventaris.print') }}" method="GET" target="_blank">
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal (Update
                            Terakhir)</label>
                        <input type="date" id="start_date" name="start_date" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" id="end_date" name="end_date" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                    <button type="button" onclick="closePrintModal()"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-200 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" onclick="closePrintModal()"
                        class="px-5 py-2.5 bg-green-600 text-white text-sm font-bold rounded-lg hover:bg-green-700 shadow-sm transition duration-200 flex items-center">
                        <i class="fas fa-print mr-2"></i> Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus item ini? Data yang dihapus tidak dapat
                dikembalikan.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
                <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById("inventoryTable");
            const thead = table.querySelector("thead");
            const tbody = table.querySelector("tbody");
            const headers = Array.from(thead.querySelectorAll("th"));
            const allRowsOriginalOrder = Array.from(tbody.querySelectorAll("tr")); // urutan asli

            // Filter/Search controls
            const searchInput = document.getElementById("searchInput");
            const categoryFilter = document.getElementById("categoryFilter");
            const statusFilter = document.getElementById("statusFilter");
            const resetBtn = document.getElementById("resetFilterBtn");

            // Indeks kolom (0-based):
            // 0 Kode | 1 Nama | 2 Kategori | 3 Stok | 4 Harga | 5 Status | 6 Updated | 7 Aksi
            const COL = {
                KODE: 0,
                NAMA: 1,
                KATEGORI: 2,
                STOK: 3,
                HARGA: 4,
                STATUS: 5
            };

            let sortState = {}; // {colIndex: 'asc'|'desc'|null}

            function getCellText(row, index) {
                return row.cells[index]?.innerText.trim() || "";
            }

            function normalizeStatus(text) {
                // "Stok Rendah" -> "stok-rendah", "Tersedia" -> "tersedia"
                return text.toLowerCase().replace(/\s+/g, "-");
            }

            function parseNumberLike(text) {
                // "Rp 1.250.000" -> 1250000 ; "25" -> 25
                const onlyDigits = text.replace(/[^0-9-]/g, "");
                return onlyDigits ? parseInt(onlyDigits, 10) : 0;
            }

            // ========== FUNGSI MODAL CETAK LAPORAN ==========
            window.openPrintModal = function() {
                const today = new Date().toISOString().split('T')[0];
                const startInput = document.getElementById('start_date');
                const endInput = document.getElementById('end_date');

                // Set default tanggal hari ini
                if (!startInput.value) startInput.value = today;
                if (!endInput.value) endInput.value = today;

                document.getElementById('printModal').classList.remove('hidden');
                document.body.style.overflow = "hidden";
            };

            window.closePrintModal = function() {
                document.getElementById('printModal').classList.add('hidden');
                document.body.style.overflow = "auto";
            };

            // --- Modal Konfirmasi Hapus ---
            let deleteFormId = null;

            window.openDeleteModal = function(id) {
                deleteFormId = `deleteForm-${id}`;
                document.getElementById('deleteModal').classList.remove('hidden');
            };

            window.closeDeleteModal = function() {
                deleteFormId = null;
                document.getElementById('deleteModal').classList.add('hidden');
            };

            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (deleteFormId) {
                    document.getElementById(deleteFormId).submit();
                }
            });

            function applyFilter() {
                const q = (searchInput.value || "").toLowerCase();
                const catValue = (categoryFilter.value || "").toLowerCase();
                const statusVal = (statusFilter.value || "").toLowerCase();

                Array.from(tbody.querySelectorAll("tr")).forEach(row => {
                    const kode = getCellText(row, COL.KODE).toLowerCase();
                    const nama = getCellText(row, COL.NAMA).toLowerCase();
                    const kategori = getCellText(row, COL.KATEGORI).toLowerCase();
                    const statusTx = normalizeStatus(getCellText(row, COL.STATUS));

                    const matchSearch = !q || kode.includes(q) || nama.includes(q) || kategori.includes(q);
                    const matchCategory = !catValue || kategori === catValue;
                    const matchStatus = !statusVal || statusTx === statusVal;

                    row.style.display = (matchSearch && matchCategory && matchStatus) ? "" : "none";
                });
            }

            function resetIcons() {
                headers.forEach(h => {
                    const icon = h.querySelector("i");
                    if (icon) icon.className = "fas fa-sort ml-1 text-gray-400";
                });
            }

            // Variabel global untuk menyimpan data riwayat sementara
            let currentHistoryData = [];

            // FUNGSI MEMBUKA MODAL DAN FETCH DATA
            window.openHistoryModal = function(productId, productName) {
                document.getElementById('historyItemName').innerText = productName.toUpperCase();
                document.getElementById('historyModal').classList.remove('hidden');
                document.body.style.overflow = "hidden";

                // Reset dropdown filter ke "Paling Baru" setiap kali modal dibuka
                document.getElementById('historySort').value = 'desc';

                const tableBody = document.getElementById('historyTableBody');
                const loading = document.getElementById('historyLoading');
                const emptyState = document.getElementById('historyEmpty');

                tableBody.innerHTML = '';
                loading.classList.remove('hidden');
                emptyState.classList.add('hidden');

                fetch(`/inventaris/${productId}/history`)
                    .then(response => response.json())
                    .then(data => {
                        loading.classList.add('hidden');

                        if (data.length === 0) {
                            emptyState.classList.remove('hidden');
                            currentHistoryData = [];
                            return;
                        }

                        // Simpan data ke variabel, data dari backend sudah berurutan "Paling Baru"
                        currentHistoryData = data;

                        // Panggil fungsi render
                        renderHistoryTable();
                    })
                    .catch(error => {
                        loading.classList.add('hidden');
                        tableBody.innerHTML =
                            `<tr><td colspan="4" class="text-center text-red-500 py-4">Gagal memuat data.</td></tr>`;
                        console.error('Error fetching history:', error);
                    });
            };

            // FUNGSI UNTUK MERENDER TABEL BERDASARKAN FILTER
            window.renderHistoryTable = function() {
                const tableBody = document.getElementById('historyTableBody');
                const sortOrder = document.getElementById('historySort').value;

                tableBody.innerHTML = ''; // Kosongkan tabel sebelum render ulang

                // Buat salinan data agar array aslinya tidak berubah secara permanen
                let dataToRender = [...currentHistoryData];

                // Jika dipilih "Paling Lama", balikkan urutan array (reverse)
                if (sortOrder === 'asc') {
                    dataToRender.reverse();
                }

                // Render baris data ke dalam tabel
                dataToRender.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50 transition duration-200';

                    row.innerHTML = `
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${item.date}</td>
                        <!-- Tambahan Data Invoice -->
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-indigo-600 font-medium">${item.invoice}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${item.menu_name}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-right font-semibold text-red-600">
                            - ${item.quantity}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-right font-semibold text-blue-600">
                            ${item.stok_akhir}
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            };

            window.closeHistoryModal = function() {
                document.getElementById('historyModal').classList.add('hidden');
                document.body.style.overflow = "auto";
            };

            window.closeHistoryModal = function() {
                document.getElementById('historyModal').classList.add('hidden');
                document.body.style.overflow = "auto";
            };

            resetBtn?.addEventListener("click", (e) => {
                e.preventDefault();

                // 1. Reset input UI
                searchInput.value = "";
                categoryFilter.value = "";
                statusFilter.value = "";

                // 2. Tampilkan semua baris kembali (hilangkan display: none)
                Array.from(tbody.querySelectorAll("tr")).forEach(row => {
                    row.style.display = "";
                });

                // 3. Kembalikan ke urutan asli (DOM order)
                allRowsOriginalOrder.forEach(row => {
                    tbody.appendChild(row);
                });

                // 4. Reset state sort dan ikon
                sortState = {};
                resetIcons();
            });

            function sortByColumn(index) {
                // Ambil hanya row yang sedang terlihat
                let visibleRows = Array.from(tbody.querySelectorAll("tr")).filter(r => r.style.display !== "none");

                // Toggle state: null -> asc -> desc -> null
                const current = sortState[index] || null;
                const next = current === null ? "asc" : (current === "asc" ? "desc" : null);
                sortState = {}; // hanya 1 kolom aktif
                sortState[index] = next;

                resetIcons();

                if (next === null) {
                    // Reset ke urutan asli tapi tetap pertahankan filter (hanya append row yang visible)
                    const originalVisible = allRowsOriginalOrder.filter(r => r.style.display !== "none");
                    originalVisible.forEach(r => tbody.appendChild(r));
                    return;
                }

                const isNumeric = (index === COL.STOK || index === COL.HARGA);

                visibleRows.sort((a, b) => {
                    let aVal, bVal;
                    if (isNumeric) {
                        aVal = index === COL.HARGA ? parseNumberLike(getCellText(a, index)) :
                            parseNumberLike(getCellText(a, index));
                        bVal = index === COL.HARGA ? parseNumberLike(getCellText(b, index)) :
                            parseNumberLike(getCellText(b, index));
                    } else {
                        aVal = getCellText(a, index).toLowerCase();
                        bVal = getCellText(b, index).toLowerCase();
                    }

                    if (aVal < bVal) return next === "asc" ? -1 : 1;
                    if (aVal > bVal) return next === "asc" ? 1 : -1;
                    return 0;
                });

                // Pasang indikator ikon
                const icon = headers[index].querySelector("i");
                if (icon) icon.className = next === "asc" ? "fas fa-caret-up ml-1 text-blue-600" :
                    "fas fa-caret-down ml-1 text-blue-600";

                // Append hasil sort (row tersembunyi tidak ikut dipindah)
                visibleRows.forEach(r => tbody.appendChild(r));
            }

            // Event: search + filter
            searchInput?.addEventListener("input", () => {
                applyFilter(); /* reset sort jika perlu */
            });
            categoryFilter?.addEventListener("change", applyFilter);
            statusFilter?.addEventListener("change", applyFilter);

            // Event: reset
            resetBtn?.addEventListener("click", (e) => {
                e.preventDefault();
                searchInput.value = "";
                categoryFilter.value = "";
                statusFilter.value = "";
                applyFilter();
                // reset sort icon + urutan asli untuk row yang terlihat
                sortState = {};
                resetIcons();
                const resetRows = allRowsOriginalOrder.filter(r => r.style.display !== "none");
                resetRows.forEach(r => tbody.appendChild(r));
            });

            // Event: sorting (klik header yang punya ikon sort)
            headers.forEach((header, idx) => {
                const icon = header.querySelector("i");
                if (!icon) return; // hanya kolom yang punya ikon
                header.style.cursor = "pointer";
                header.addEventListener("click", () => sortByColumn(idx));
            });

            // Inisialisasi awal
            applyFilter();
        });
    </script>


@endsection
