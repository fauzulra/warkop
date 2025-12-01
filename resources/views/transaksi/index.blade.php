@extends('layout.app')
@section('title', 'Data Transaksi')
@section('page-title', 'Data Transaksi')
@section('content')
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4 mt-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full  text-emerald-600">
                                <i class="fas fa-receipt text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                                <p class="text-2xl font-bold text-gray-900">247</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full  text-green-600">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Selesai</p>
                                <p class="text-2xl font-bold text-gray-900">198</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full  text-yellow-600">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Ongoing</p>
                                <p class="text-2xl font-bold text-gray-900">42</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full  text-blue-600">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                                <p class="text-2xl font-bold text-gray-900">Rp 2.8M</p>
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
                                        <input type="date"
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
                                        <button
                                            class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200 flex items-center justify-center font-medium whitespace-nowrap min-w-[100px]">
                                            <i class="fas fa-redo mr-2"></i>
                                            Reset Filter
                                        </button>
                                    </div>
                                    <!-- Menu -->
                                    {{-- <div class="flex-grow">
                                        <button
                                            class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200 flex items-center justify-center font-medium whitespace-nowrap min-w-[160px]">
                                            <svg class="w-4 h-4 mr-2 text-gray-500 transition duration-75"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                                            </svg>
                                            Menu
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Action Buttons -->
                        <div class="xl:w-[200px] flex flex-col justify-center">
                            <div class="space-y-3">
                                <a href={{ route('menu.index') }}>
                                    <button
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center font-medium">
                                        <i class="fas fa-plus mr-2"></i>
                                        Transaksi Baru
                                    </button>
                                </a>
                                <button
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center font-medium">
                                    <i class="fas fa-download mr-2"></i>
                                    Export Data
                                </button>
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
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                    <tr class="hover:bg-gray-50 transition duration-200">
                                        <!-- ID Transaksi -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                            {{ $sale->invoice_number }}
                                        </td>

                                        <!-- Tanggal & Waktu -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($sale->sale_date)->format('h:i A') }}
                                            </div>
                                        </td>

                                        <!-- Item -->
                                        <td class="px-6 py-4 whitespace-nowrap"
                                            onclick="showSaleDetail({{ $sale->id }})">
                                            <div class="text-sm
                                            text-gray-900">
                                                @foreach ($sale->items->take(2) as $item)
                                                    {{ $item->menu->name ?? '-' }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                                {{-- Jika lebih dari 3 item --}}
                                                @if ($sale->items->count() > 2)
                                                    ....
                                                @endif
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $sale->items->count() }} item{{ $sale->items->count() > 1 ? 's' : '' }}
                                            </div>
                                        </td>
                                        <!-- Total -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($sale->total, 0, ',', '.') }}
                                        </td>
                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock text-yellow-400 mr-1 text-xs"></i>
                                                Ongoing
                                            </span>
                                        </td>
                                        <!-- Aksi -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 transition duration-200"
                                                    title="Detail" onclick="showSaleDetail({{ $sale->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button onclick="editSale({{ $sale->id }})"
                                                    class="text-green-600 hover:text-green-900 transition duration-200"
                                                    title="edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('transaksi.destroy', $sale->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus transaksi ini?')"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
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
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                            Belum ada transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-6 mt-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-700">
                                <span>Menampilkan</span>
                                <select class="mx-2 border border-gray-300 rounded pr-7 pl-2 py-1 text-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>dari 247 total transaksi</span>
                            </div>

                            <div class="flex items-center space-x-1">
                                <button
                                    class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded">1</button>
                                <button
                                    class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">2</button>
                                <button
                                    class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">3</button>
                                <button
                                    class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">...</button>
                                <button
                                    class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">25</button>
                                <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <div id="statusModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Ubah Status Pesanan</h3>
                        <button type="button" id="closeModal"
                            class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal Body -->
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
                                <!-- Ongoing Option -->
                                <label
                                    class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                    <input type="radio" name="newStatus" value="ongoing"
                                        class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock text-yellow-400"></i>
                                            Ongoing
                                        </span>
                                    </div>
                                </label>

                                <!-- Selesai Option -->
                                <label
                                    class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                    <input type="radio" name="newStatus" value="selesai"
                                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle text-green-400 mr-1 text-xs"></i>
                                            Selesai
                                        </span>
                                    </div>
                                </label>

                                <!-- Dibatalkan Option -->
                                <label
                                    class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                                    <input type="radio" name="newStatus" value="dibatalkan"
                                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle text-red-400 mr-1 text-xs"></i>
                                            Dibatalkan
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end space-x-3">
                        <button type="button" id="cancelButton"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-200">
                            Batal
                        </button>
                        <button type="button" id="saveStatusButton"
                            class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
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

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let currentStatusButton = null;
                    let currentRow = null;

                    // =====================
                    // Open / Close Status Modal
                    // =====================
                    function openStatusModal(button, row) {
                        const modal = document.getElementById("statusModal");
                        if (!modal) return;

                        const transactionId = row.querySelector("td:first-child").textContent;
                        const currentStatusElement = row.querySelector(".inline-flex");

                        document.getElementById("modalTransactionId").textContent = transactionId;

                        const statusClone = currentStatusElement.cloneNode(true);
                        const currentStatusContainer = document.getElementById("modalCurrentStatus");
                        currentStatusContainer.innerHTML = "";
                        currentStatusContainer.appendChild(statusClone);

                        document.querySelectorAll('input[name="newStatus"]').forEach(radio => (radio.checked = false));

                        currentStatusButton = button;
                        currentRow = row;

                        modal.classList.remove("hidden");
                        document.body.style.overflow = "hidden";
                    }

                    function closeStatusModal() {
                        const modal = document.getElementById("statusModal");
                        if (!modal) return;
                        modal.classList.add("hidden");
                        document.body.style.overflow = "auto";
                        currentStatusButton = null;
                        currentRow = null;
                    }

                    // =====================
                    // Show Detail Modal
                    // =====================
                    window.showSaleDetail = function(saleId) {
                        fetch(`/transaksi/${saleId}/detail`)
                            .then(res => res.json())
                            .then(data => {
                                let content = "";
                                data.items.forEach(item => {
                                    const addons = item.addons.length > 0 ?
                                        item.addons.map(a => `- ${a.name}`).join("<br>") :
                                        "<p>Tidak ada addon</p>";
                                    const formatSentenceCase = str => str.charAt(0).toUpperCase() + str
                                        .slice(1);
                                    const note = item.note ?
                                        `<b>Catatan:</b> ${formatSentenceCase(item.note)}` :
                                        "<p>Tidak ada catatan</p>";

                                    content += `
                        <div class="border-b pb-2">
                            <div><b>${item.menu_name}</b> × ${item.quantity}</div>
                            <div>${note}</div>
                            <div>${addons}</div>
                        </div>
                    `;
                                });

                                document.getElementById("detailContent").innerHTML = content;
                                document.getElementById("detailModal").classList.remove("hidden");
                            })
                            .catch(err => {
                                console.error(err);
                                alert("Gagal mengambil detail transaksi");
                            });
                    };

                    window.closeModal = function() {
                        const modal = document.getElementById("detailModal");
                        if (modal) modal.classList.add("hidden");
                    };

                    // =====================
                    // Edit Transaction
                    // =====================
                    window.editSale = function(id) {
                        fetch(`/transaksi/${id}/edit`)
                            .then(res => res.json())
                            .then(data => {
                                document.getElementById("editId").value = data.id;
                                document.getElementById("editCustomer").value = data.customer_name;
                                document.getElementById("editTotal").value = data.total;
                                document.getElementById("editNote").value = data.note ?? "";
                                document.getElementById("editModal").classList.remove("hidden");
                            })
                            .catch(err => console.error(err));
                    };

                    window.closeEditModal = function() {
                        const modal = document.getElementById("editModal");
                        if (modal) modal.classList.add("hidden");
                    };

                    // =====================
                    // Save Edit
                    // =====================
                    const editForm = document.getElementById("editForm");
                    if (editForm) {
                        editForm.addEventListener("submit", function(e) {
                            e.preventDefault();
                            const id = document.getElementById("editId").value;
                            const formData = new FormData(this);

                            fetch(`/transaksi/${id}`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: formData
                                })
                                .then(res => {
                                    if (!res.ok) throw new Error("Gagal update");
                                    return res.json();
                                })
                                .then(data => {
                                    closeEditModal();
                                    showSuccessMessage("Data transaksi berhasil diperbarui!");
                                    setTimeout(() => location.reload(), 1000);
                                })
                                .catch(err => console.error(err));
                        });
                    }

                    // =====================
                    // Status HTML Generator
                    // =====================
                    function getStatusHTML(status) {
                        const statusConfigs = {
                            ongoing: {
                                class: "bg-yellow-100 text-yellow-800",
                                icon: "fas fa-clock text-yellow-400",
                                text: "Ongoing"
                            },
                            selesai: {
                                class: "bg-green-100 text-green-800",
                                icon: "fas fa-check-circle text-green-400",
                                text: "Selesai"
                            },
                            dibatalkan: {
                                class: "bg-red-100 text-red-800",
                                icon: "fas fa-times-circle text-red-400",
                                text: "Dibatalkan"
                            }
                        };
                        const config = statusConfigs[status];
                        return `
            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full ${config.class}">
                <i class="${config.icon} mr-1 text-xs"></i>${config.text}
            </span>
        `;
                    }

                    // =====================
                    // General Click Handlers
                    // =====================
                    document.addEventListener("click", function(e) {
                        // Open Status Modal
                        if (e.target.closest(".inline-flex") &&
                            (e.target.closest(".inline-flex").textContent.includes("Ongoing") ||
                                e.target.closest(".inline-flex").textContent.includes("Selesai") ||
                                e.target.closest(".inline-flex").textContent.includes("Dibatalkan"))) {
                            const button = e.target.closest(".inline-flex");
                            const row = button.closest("tr");
                            openStatusModal(button, row);
                            return;
                        }

                        // Delete Transaction
                        if (e.target.classList.contains("fa-trash") || e.target.closest("button")?.querySelector(
                                ".fa-trash")) {
                            const button = e.target.closest("button");
                            if (confirm("Apakah Anda yakin ingin menghapus transaksi ini?")) {
                                const row = button.closest("tr");
                                row.style.animation = "fadeOut 0.3s ease-out";
                                setTimeout(() => row.remove(), 300);
                            }
                        }
                    });

                    // =====================
                    // Save Status Modal
                    // =====================
                    const saveStatusButton = document.getElementById("saveStatusButton");
                    if (saveStatusButton) {
                        saveStatusButton.addEventListener("click", function() {
                            const selectedStatus = document.querySelector('input[name="newStatus"]:checked');
                            if (!selectedStatus) {
                                alert("Silakan pilih status baru");
                                return;
                            }

                            const newStatus = selectedStatus.value;

                            if (currentStatusButton && currentRow) {
                                const statusCell = currentRow.querySelector(".inline-flex").parentElement;
                                statusCell.innerHTML = getStatusHTML(newStatus);
                                statusCell.style.transform = "scale(1.05)";
                                setTimeout(() => (statusCell.style.transform = ""), 200);
                            }

                            closeStatusModal();
                        });
                    }

                    // =====================
                    // Search Filter
                    // =====================
                    const searchInput = document.getElementById("searchInput");
                    if (searchInput) {
                        searchInput.addEventListener("input", function(e) {
                            const searchTerm = e.target.value.toLowerCase();
                            const rows = document.querySelectorAll("#tableBody tr");
                            rows.forEach(row => {
                                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ?
                                    "" : "none";
                            });
                        });
                    }

                    // =====================
                    // Status Filter
                    // =====================
                    const statusFilter = document.getElementById("statusFilter");
                    if (statusFilter) {
                        statusFilter.addEventListener("change", function() {
                            const selected = this.value;
                            const rows = document.querySelectorAll("#tableBody tr");
                            rows.forEach(row => {
                                const statusText = row.querySelector(".inline-flex")?.textContent
                                    .toLowerCase() || "";
                                let show = !selected ||
                                    (selected === "selesai" && statusText.includes("selesai")) ||
                                    (selected === "ongoing" && statusText.includes("ongoing")) ||
                                    (selected === "dibatalkan" && statusText.includes("dibatalkan"));
                                row.style.display = show ? "" : "none";
                            });
                        });
                    }

                    // =====================
                    // Date Filter
                    // =====================
                    const dateInput = document.querySelector('input[type="date"]');
                    if (dateInput) {
                        dateInput.addEventListener("change", function() {
                            const selectedDate = this.value;
                            const rows = document.querySelectorAll("#tableBody tr");
                            rows.forEach(row => {
                                const dateCell = row.querySelector("td:nth-child(2)");
                                if (!dateCell) return;
                                const text = dateCell.textContent.trim();
                                let normalized = text.includes("/") ?
                                    text.split("/").reverse().join("-") :
                                    text;
                                row.style.display = !selectedDate || normalized === selectedDate ? "" :
                                    "none";
                            });
                        });
                    }

                    // =====================
                    // Reset Filter
                    // =====================
                    document.addEventListener("click", function(e) {
                        if (e.target.textContent.includes("Reset Filter")) {
                            document.querySelectorAll("select").forEach(s => (s.value = ""));
                            const dateInput = document.querySelector('input[type="date"]');
                            if (dateInput) dateInput.value = "";
                            const searchInput = document.getElementById("searchInput");
                            if (searchInput) searchInput.value = "";
                            document.querySelectorAll("#tableBody tr").forEach(r => (r.style.display = ""));
                        }
                    });

                    // =====================
                    // Toast Notification
                    // =====================
                    function showSuccessMessage(message) {
                        const existing = document.querySelector(".success-toast");
                        if (existing) existing.remove();
                        const toast = document.createElement("div");
                        toast.className =
                            "success-toast fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50";
                        toast.innerHTML = `<i class="fas fa-check mr-2"></i>${message}`;
                        document.body.appendChild(toast);
                        setTimeout(() => {
                            toast.style.opacity = "0";
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }

                    // Animations
                    const style = document.createElement("style");
                    style.textContent = `
        @keyframes fadeOut { from{opacity:1;} to{opacity:0;} }
        @keyframes fadeIn { from{opacity:0;} to{opacity:1;} }
    `;
                    document.head.appendChild(style);
                });
            </script>

        @endsection
