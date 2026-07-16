@extends('layout.app')
@section('title', 'Data Transaksi')
@section('page-title', 'Data Transaksi')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            @php
                function formatRupiah($angka)
                {
                    if ($angka >= 1000000) {
                        return number_format($angka / 1000000, 1) . 'M';
                    } elseif ($angka >= 1000) {
                        return number_format($angka / 1000, 0) . 'K';
                    }
                    return number_format($angka, 0, ',', '.');
                }
            @endphp

            <!-- Stats Cards -->
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight mt-2 px-2">
                Data Transaksi Hari Ini
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4 mt-4">

                <!-- Total Transaksi -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full text-emerald-600">
                            <i class="fas fa-receipt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalTransaksi }}</p>
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full text-green-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $selesai }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ongoing -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full text-yellow-600">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Ongoing</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $ongoing }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pendapatan -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full text-blue-600">
                            <i class="fas fa-dollar-sign text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ formatRupiah($totalPendapatan) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2 py-6">
                <div class="flex flex-col xl:flex-row gap-6">
                    <!-- Left Side: Filter & Search Controls -->
                    <div class="flex-1">
                        <div class="space-y-3">
                            <!-- Search Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="searchInput" placeholder="Cari transaksi..."
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            </div>
                            <!-- Filter Controls Row - Optimized Grid -->
                            <div class="flex flex-wrap gap-4">
                                <!-- Date Filter -->
                                <div class="flex-grow min-w-[180px]">
                                    <input type="date" id="dateFilter"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 bg-white">
                                </div>

                                <!-- Reset Button -->
                                <div class="flex-grow">
                                    <select
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-white"
                                        id="statusFilter">
                                        <option value="">Semua Status</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="ongoing">Ongoing</option>
                                        <option value="dibatalkan">Dibatalkan</option>
                                    </select>
                                </div>
                                <div class="flex-grow">
                                    <button id="resetFilterBtn"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200 flex items-center justify-center font-medium whitespace-nowrap min-w-[100px]">
                                        <i class="fas fa-redo mr-2"></i>
                                        Reset Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Action Buttons -->
                    <div class="xl:w-[200px] flex flex-col justify-center">
                        <div class="space-y-3">
                            <a href="{{ route('transaksi.newOrder') }}">
                                <button
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center font-medium">
                                    <i class="fas fa-plus mr-2"></i>
                                    Transaksi Baru
                                </button>
                            </a>

                            @role('admin')
                                <button onclick="openPrintModal()"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center font-medium">
                                    <i class="fas fa-print mr-2"></i>
                                    Cetak Laporan
                                </button>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-2 pb-10">
        <!-- Transaction Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ">
            <div class="overflow-x-auto ">
                <table class="min-w-full divide-y divide-gray-200" id="transactionTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                ID Transaksi <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Tanggal & Waktu <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Item <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Total <i class="fas fa-sort ml-1"></i>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showSuccessMessage(@json(session('success')));
                            });
                        </script>
                    @endif
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @forelse ($sales as $sale)
                            <tr class="hover:bg-gray-50 transition duration-200" data-id="{{ $sale->id }}">

                                <!-- 1. ID Transaksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                    {{ $sale->invoice_number }}
                                </td>

                                <!-- 2. Tanggal & Waktu -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('h:i A') }}
                                    </div>
                                </td>

                                <!-- 3. Item -->
                                <td class="px-6 py-4 whitespace-nowrap cursor-pointer hover:bg-gray-100"
                                    onclick="showSaleDetail({{ $sale->id }})">
                                    <div class="text-sm text-gray-900">
                                        @foreach ($sale->items->take(2) as $item)
                                            {{ ucwords($item->menu->name ?? '-') }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                        @if ($sale->items->count() > 2)
                                            ....
                                        @endif
                                    </div>

                                    <!-- Bagian yang diubah: Menggunakan sum('quantity') agar lebih akurat -->
                                    <div class="text-sm text-gray-500">
                                        @php
                                            $totalQty = $sale->items->sum('quantity');
                                        @endphp
                                        {{ $totalQty }} item{{ $totalQty > 1 ? 's' : '' }}
                                    </div>
                                </td>

                                <!-- 4. Total -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($sale->total, 0, ',', '.') }}
                                </td>

                                <!-- 5. Status Dinamis -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            'ongoing' => [
                                                'class' => 'bg-yellow-100 text-yellow-800',
                                                'icon' => 'fa-clock text-yellow-400',
                                                'text' => 'Ongoing',
                                            ],
                                            'selesai' => [
                                                'class' => 'bg-green-100 text-green-800',
                                                'icon' => 'fa-check-circle text-green-400',
                                                'text' => 'Selesai',
                                            ],
                                            'dibatalkan' => [
                                                'class' => 'bg-red-100 text-red-800',
                                                'icon' => 'fa-times-circle text-red-400',
                                                'text' => 'Dibatalkan',
                                            ],
                                        ];
                                        // Pastikan status ada nilainya, default 'ongoing'
                                        $currentStatus = $statusConfig[$sale->status ?? 'ongoing'];
                                    @endphp
                                    <button type="button"
                                        onclick="openStatusModal('{{ $sale->id }}', '{{ $sale->invoice_number }}', '{{ $sale->status ?? 'ongoing' }}')"
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full cursor-pointer hover:shadow-md transition-all {{ $currentStatus['class'] }}">
                                        <i class="fas {{ $currentStatus['icon'] }} mr-1 text-xs"></i>
                                        {{ $currentStatus['text'] }}
                                    </button>
                                </td>

                                <!-- 6. Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <!-- Tombol Detail -->
                                        <button class="text-blue-600 hover:text-blue-900 transition duration-200"
                                            title="Detail" onclick="showSaleDetail({{ $sale->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Pengecekan Status untuk Tombol Edit -->
                                        @if (($sale->status ?? 'ongoing') === 'ongoing')
                                            <!-- Jika Ongoing: Tombol Edit Aktif -->
                                            <a href="{{ route('transaksi.editOrder', $sale->id) }}"
                                                class="text-green-600 hover:text-green-900 transition duration-200"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <!-- Jika Selesai/Dibatalkan: Tombol Edit Disabled (Nonaktif) -->
                                            <button type="button" disabled class="text-gray-300 cursor-not-allowed"
                                                title="Edit ditutup (Transaksi sudah {{ $sale->status }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif

                                        <!-- Tombol Hapus -->
                                        <form id="deleteForm-{{ $sale->id }}"
                                            action="{{ route('transaksi.destroy', $sale->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="openDeleteModal('{{ $sale->id }}')"
                                                class="text-red-600 hover:text-red-900 transition duration-200"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">

            <form id="updateStatusForm" method="POST" action="">
                @csrf
                @method('PATCH')

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Ubah Status Pesanan</h3>
                    <button type="button" id="closeStatusModalBtn"
                        class="text-gray-400 hover:text-gray-600 transition duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">ID Transaksi:</p>
                        <p id="modalTransactionId" class="font-mono font-semibold text-gray-900"></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Status Saat Ini:</p>
                        <span id="modalCurrentStatus"
                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full"></span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Status Baru:</label>
                        <div class="space-y-3">
                            <!-- Opsi Ongoing -->
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                <input type="radio" id="radio_ongoing" name="status" value="ongoing"
                                    class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300" required>
                                <div class="ml-3 flex items-center">
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock text-yellow-400 mr-1"></i> Ongoing
                                    </span>
                                </div>
                            </label>

                            <!-- Opsi Selesai -->
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                <input type="radio" id="radio_selesai" name="status" value="selesai"
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300" required>
                                <div class="ml-3 flex items-center">
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle text-green-400 mr-1 text-xs"></i> Selesai
                                    </span>
                                </div>
                            </label>

                            <!-- Opsi Dibatalkan -->
                            <label
                                class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                <input type="radio" id="radio_dibatalkan" name="status" value="dibatalkan"
                                    class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300" required>
                                <div class="ml-3 flex items-center">
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle text-red-400 mr-1 text-xs"></i> Dibatalkan
                                    </span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <button type="button" id="cancelButton"
                        class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" id="saveStatusButton"
                        class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Detail -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white w-[500px] p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
            <div id="detailContent" class="space-y-3"></div>
            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Tutup
            </button>
        </div>
    </div>

    <!-- Modal Cetak Laporan -->
    <div id="printModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md relative">
            <!-- Header Modal -->
            <div class="flex items-center justify-between mb-4 border-b pb-4">
                <h3 class="text-lg font-bold text-gray-800">Filter Laporan Transaksi</h3>
                <button type="button" onclick="closePrintModal()"
                    class="text-gray-400 hover:text-red-500 bg-gray-100 hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Form Filter -->
            <form action="{{ route('transaksi.print') }}" method="GET" target="_blank">
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
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
                        class="px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 shadow-sm transition duration-200 flex items-center">
                        <i class="fas fa-print mr-2"></i> Cetak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-6 border shadow-xl rounded-xl bg-white max-w-2xl">
            <div class="flex items-center justify-between mb-6 border-b pb-4">
                <h3 class="text-xl font-bold text-gray-900">Edit Transaksi</h3>
                <button type="button" onclick="closeEditModal()"
                    class="text-gray-400 hover:text-red-500 bg-gray-100 hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editForm">
                <!-- Hidden ID -->
                <input type="hidden" id="editId" name="id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                        <input type="text" id="editCustomer" name="customer_name"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Pesanan</label>
                        <input type="text" id="editNote" name="note"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                </div>

                <!-- Bagian Daftar Menu yang Dipesan -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Menu yang Dipesan</label>
                    <div class="border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                        <div id="editItemsList" class="max-h-60 overflow-y-auto p-4 space-y-2 bg-white">
                            <!-- Daftar item akan dirender oleh JavaScript di sini -->
                        </div>
                    </div>
                </div>

                <div class="mb-6 flex items-center justify-between bg-emerald-50 p-4 rounded-lg border border-emerald-100">
                    <label class="text-lg font-bold text-gray-800">Total Keseluruhan</label>
                    <div class="relative w-1/2">
                        <span class="absolute left-3 top-2.5 text-gray-600 font-bold">Rp</span>
                        <!-- Dibuat readonly karena total akan otomatis dihitung dari item -->
                        <input type="number" id="editTotal" name="total" readonly
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-gray-100 font-bold text-gray-900 focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                    <button type="button" onclick="closeEditModal()"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-200 transition duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-600 text-white text-sm font-bold rounded-lg hover:bg-emerald-700 shadow-sm transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus transaksi ini? Data yang dihapus tidak dapat
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
        (function() {
            // ========== GLOBALS ==========
            let currentEditItems = []; // State untuk item dalam modal edit

            // ========== FUNGSI MODAL STATUS ==========
            window.openStatusModal = function(id, invoiceNumber, currentStatus) {
                const modal = document.getElementById("statusModal");
                if (!modal) return;
                const url = `/transaksi/${id}/update-status`;
                const form = document.getElementById("updateStatusForm");
                if (form) form.action = url;

                document.getElementById("modalTransactionId").textContent = invoiceNumber;

                if (currentStatus === 'selesai') document.getElementById('radio_selesai').checked = true;
                else if (currentStatus === 'dibatalkan') document.getElementById('radio_dibatalkan').checked = true;
                else document.getElementById('radio_ongoing').checked = true;

                modal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
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

            document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
                if (deleteFormId) {
                    document.getElementById(deleteFormId).submit();
                }
            });

            // ========== FUNGSI MODAL CETAK LAPORAN ==========
            window.openPrintModal = function() {
                // Set default tanggal ke hari ini
                const today = new Date().toISOString().split('T')[0];
                const startInput = document.getElementById('start_date');
                const endInput = document.getElementById('end_date');

                if (!startInput.value) startInput.value = today;
                if (!endInput.value) endInput.value = today;

                document.getElementById('printModal').classList.remove('hidden');
                document.body.style.overflow = "hidden"; // Mencegah scroll di background
            };

            window.closePrintModal = function() {
                document.getElementById('printModal').classList.add('hidden');
                document.body.style.overflow = "auto";
            };

            // ========== FUNGSI MODAL DETAIL ==========
            window.showSaleDetail = function(saleId) {
                fetch(`/transaksi/${saleId}/detail`)
                    .then(res => res.json())
                    .then(data => {
                        let content = "";
                        data.items.forEach(item => {
                            const addons = item.addons && item.addons.length > 0 ?
                                item.addons.map(a => `- ${a.name}`).join("<br>") :
                                "<span class='text-gray-500'>Tidak ada addon</span>";
                            content += `
                            <div class="border-b pb-2 mb-2">
                                <div class="font-medium">${item.menu_name} × ${item.quantity}</div>
                                <div class="text-sm text-gray-600">${addons}</div>
                            </div>`;
                        });
                        document.getElementById("detailContent").innerHTML = content;
                        document.getElementById("detailModal").classList.remove("hidden");
                    });
            };

            window.closeModal = () => {
                const modal = document.getElementById("detailModal");
                if (modal) modal.classList.add("hidden");
            };

            window.closeStatusModal = () => {
                const modal = document.getElementById("statusModal");
                if (modal) {
                    modal.classList.add("hidden");
                    document.body.style.overflow = "auto";
                }
            };
            document.getElementById('closeStatusModalBtn')?.addEventListener('click', window.closeStatusModal);
            document.getElementById('cancelButton')?.addEventListener('click', window.closeStatusModal);

            // ========== FUNGSI MODAL EDIT TRANSAKSI ==========
            window.editSale = function(id) {
                document.getElementById("editModal").classList.remove("hidden");
                document.getElementById("editId").value = id;

                fetch(`/transaksi/${id}/edit`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById("editCustomer").value = data.customer_name || "";
                        document.getElementById("editNote").value = data.note || "";

                        currentEditItems = [];

                        // LOGIKA MERGING (GABUNGKAN ITEM JIKA SAMA)
                        (data.items || []).forEach(item => {
                            // Cari apakah menu_name sudah ada di dalam array
                            let existingItem = currentEditItems.find(i => i.name === item.menu_name);

                            if (existingItem) {
                                // Jika sudah ada, cukup tambahkan quantity-nya (tidak beda card)
                                existingItem.quantity += parseInt(item.quantity);
                            } else {
                                // Jika belum ada, buat item baru
                                currentEditItems.push({
                                    id: item.menu_id || item
                                        .id, // Sesuaikan dengan response JSON Anda
                                    name: item.menu_name,
                                    price: parseInt(item.price),
                                    quantity: parseInt(item.quantity)
                                });
                            }
                        });
                        renderEditItems();
                    });
            };

            // FUNGSI TAMBAHAN: Gunakan fungsi ini jika Anda ingin menambahkan menu baru ke pesanan lewat UI Modal Edit
            window.tambahMenuKeEditOrder = function(menuId, menuName, menuPrice, qty = 1) {
                let existingItem = currentEditItems.find(i => i.name === menuName);

                if (existingItem) {
                    // Bertambah jumlahnya jika menu sama
                    existingItem.quantity += qty;
                } else {
                    // Buat card baru jika menu belum ada
                    currentEditItems.push({
                        id: menuId,
                        name: menuName,
                        price: parseInt(menuPrice),
                        quantity: qty
                    });
                }
                renderEditItems();
            };

            window.renderEditItems = function() {
                const container = document.getElementById("editItemsList");
                let html = "";
                let calcTotal = 0;

                currentEditItems.forEach((item, idx) => {
                    const subtotal = item.price * item.quantity;
                    calcTotal += subtotal;
                    html += `
                    <div class="flex justify-between items-center py-2 border-b">
                        <div><p class="text-sm font-bold">${item.name}</p><p class="text-xs">Rp ${item.price.toLocaleString('id-ID')}</p></div>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="changeEditQty(${idx}, -1)" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 transition rounded">-</button>
                            <span class="w-8 text-center font-bold">${item.quantity}</span>
                            <button type="button" onclick="changeEditQty(${idx}, 1)" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 transition rounded">+</button>
                            <button type="button" onclick="removeEditItem(${idx})" class="text-red-500 hover:text-red-700 ml-2"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>`;
                });

                if (currentEditItems.length === 0) {
                    html = `<p class="text-center text-gray-500 py-4 text-sm">Tidak ada item pesanan.</p>`;
                }

                container.innerHTML = html;
                document.getElementById("editTotal").value = calcTotal;
            };

            window.changeEditQty = function(idx, delta) {
                currentEditItems[idx].quantity += delta;
                if (currentEditItems[idx].quantity <= 0) {
                    currentEditItems.splice(idx, 1);
                }
                renderEditItems();
            };

            window.removeEditItem = function(idx) {
                if (confirm("Hapus item ini dari pesanan?")) {
                    currentEditItems.splice(idx, 1);
                    renderEditItems();
                }
            };

            window.closeEditModal = function() {
                document.getElementById("editModal").classList.add("hidden");
            };

            // ========== FORM SUBMIT & UTILS ==========
            function showSuccessMessage(message) {
                const toast = document.createElement("div");
                toast.className =
                    "fixed top-4 right-4 bg-emerald-600 text-white px-6 py-3 rounded-lg shadow-lg z-[100]";
                toast.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${message}`;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            }

            document.addEventListener("DOMContentLoaded", function() {
                // Submit Edit Form
                document.getElementById("editForm")?.addEventListener("submit", function(e) {
                    e.preventDefault();

                    if (currentEditItems.length === 0) {
                        alert("Pesanan tidak boleh kosong!");
                        return;
                    }

                    const id = document.getElementById("editId").value;
                    const formData = new FormData(this);
                    formData.append('_method', 'PUT');
                    formData.append('items', JSON.stringify(currentEditItems));

                    fetch(`/transaksi/${id}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                ?.content || "{{ csrf_token() }}"
                        },
                        body: formData
                    }).then(res => {
                        if (res.ok) {
                            showSuccessMessage("Data berhasil diperbarui!");
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            alert("Terjadi kesalahan saat menyimpan data.");
                        }
                    }).catch(err => {
                        console.error(err);
                        alert("Gagal menghubungi server.");
                    });
                });

                // ========== FILTER TABLE (Search, Date, Status) ==========
                const searchInput = document.getElementById("searchInput");
                const dateFilter = document.getElementById("dateFilter");
                const statusFilter = document.getElementById("statusFilter");
                const resetFilterBtn = document.getElementById("resetFilterBtn");

                function applyFilters() {
                    const searchTerm = searchInput ? searchInput.value.toLowerCase() : "";
                    const dateTerm = dateFilter ? dateFilter.value : ""; // Format: YYYY-MM-DD
                    const statusTerm = statusFilter ? statusFilter.value.toLowerCase() : "";

                    document.querySelectorAll("#tableBody tr").forEach(row => {
                        const rowText = row.textContent.toLowerCase();
                        const dateCellText = row.querySelector("td:nth-child(2)").textContent.trim();
                        const statusCellText = row.querySelector("td:nth-child(5)").textContent
                            .toLowerCase().trim();

                        const matchSearch = rowText.includes(searchTerm);
                        const matchDate = dateTerm === "" || dateCellText.includes(dateTerm);
                        const matchStatus = statusTerm === "" || statusCellText.includes(statusTerm);

                        if (matchSearch && matchDate && matchStatus) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                }

                if (searchInput) searchInput.addEventListener("input", applyFilters);
                if (dateFilter) dateFilter.addEventListener("change", applyFilters);
                if (statusFilter) statusFilter.addEventListener("change", applyFilters);

                if (resetFilterBtn) {
                    resetFilterBtn.addEventListener("click", function() {
                        if (searchInput) searchInput.value = "";
                        if (dateFilter) dateFilter.value = "";
                        if (statusFilter) statusFilter.value = "";
                        applyFilters();
                    });
                }
            });
        })();
    </script>

@endsection
