@extends('layout.app')
@section('title', 'Data Menu')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        .modal-scrollable {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow-y: auto;
            padding: 1rem;
        }

        .modal-content {
            min-height: calc(100vh - 2rem);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-dialog {
            max-height: 90vh;
            overflow-y: auto;
            margin: 2rem auto;
        }
    </style>
@endsection
@section('content')
    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto p-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Panel - Menu Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    @if (session('success'))
                        <div id="flash-toast"
                            class="success-toast fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50"
                            style="animation: fadeIn 0.3s ease-in;">
                            <i class="fas fa-check mr-2"></i>{{ session('success') }}
                        </div>

                        <script>
                            setTimeout(() => {
                                const toast = document.getElementById('flash-toast');
                                if (toast) {
                                    toast.style.animation = 'fadeOut 0.3s ease-out';
                                    setTimeout(() => toast.remove(), 300);
                                }
                            }, 3000);
                        </script>
                    @endif

                    <!-- Filter & Search -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <!-- Search -->
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="menuSearch" placeholder="Cari menu..."
                                    class="block w-full pl-8 pr-2 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            </div>

                            <!-- Category Filter -->
                            <select id="categoryFilter"
                                class="pl-2 pr-5 py-3  border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 bg-white min-w-[150px]">
                                <option value="">Semua Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="snack">Snack</option>
                            </select>

                            <!-- Add Menu Button -->
                            <a href="{{ route('menu.create') }}">
                                <button id=""
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-3   py-3 rounded-lg transition duration-200 flex items-center justify-center font-medium whitespace-nowrap">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Menu
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- Menu Grid dengan Add-ons Support --}}
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4" id="menuGrid">
                            @forelse($menuItems as $item)
                                <div class="menu-item bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-200 overflow-hidden {{ !$item->is_active ? 'opacity-60' : '' }}
                flex flex-col h-full"
                                    data-category="{{ $item->category }}" data-name="{{ strtolower($item->name) }}">

                                    <!-- Image -->
                                    <div class="relative h-40 overflow-hidden">
                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/300x200/e5e7eb/9ca3af?text=No+Image' }}"
                                            alt="{{ $item->name }}"
                                            class="w-full h-full object-cover transition duration-300 hover:scale-105">

                                        @if (!$item->is_active)
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                                <span class="text-white font-semibold">HABIS</span>
                                            </div>
                                        @endif

                                        <span
                                            class="absolute top-2 right-2 text-xs px-2 py-1 rounded-full 
                        @if ($item->category === 'makanan') bg-blue-100 text-blue-800
                        @elseif($item->category === 'minuman') bg-green-100 text-green-800
                        @else bg-orange-100 text-orange-800 @endif">
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-4 flex flex-col flex-1">

                                        <!-- Judul & Deskripsi -->
                                        <div class="mb-3 min-h-[60px]"> <!-- kasih tinggi minimal -->
                                            <h4 class="font-semibold text-gray-900 text-lg line-clamp-1">
                                                {{ $item->name }}
                                            </h4>
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {{ $item->description }}
                                            </p>
                                        </div>

                                        <!-- Harga (selalu di atas tombol) -->
                                        <div class="mt-auto mb-2">
                                            <span class="text-xl font-bold text-emerald-600">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <!-- Tombol -->
                                        <div class="flex items-center justify-center gap-1.5 pt-3 border-t border-gray-100">
                                            <button onclick="editMenu({{ $item->id }})"
                                                class="text-blue-600 hover:text-blue-700 p-2 rounded hover:bg-blue-50 transition duration-200">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 p-2 rounded hover:bg-red-50 transition duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                            <div class="flex items-center flex-1">
                                                @if ($item->is_active)
                                                    <button
                                                        onclick="addToCart({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, '{{ $item->category }}')"
                                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg text-sm font-medium flex items-center justify-center gap-2">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Tambah</span>
                                                    </button>
                                                @else
                                                    <button disabled
                                                        class="w-full bg-gray-300 text-gray-500 px-3 py-2 rounded-lg text-sm font-medium">
                                                        Habis
                                                    </button>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">Belum ada menu tersedia</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Cart/Order -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 sticky top-4">
                    <!-- Cart Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Pesanan Baru</h3>
                            <button id="clearCart" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus Semua
                            </button>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="p-6 border-b border-gray-200 max-h-96 overflow-y-auto" id="cartItems">
                        <div class="text-center text-gray-500 py-8">
                            <i class="fas fa-shopping-cart text-4xl mb-3"></i>
                            <p>Belum ada item yang dipilih</p>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="space-y-2">
                            <div class="flex justify-between text-lg font-bold pt-2 border-t">
                                <span>Total:</span>
                                <span id="total">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-6 space-y-3">
                        <button id="processOrder"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-medium transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <i class="fas fa-check mr-2"></i>
                            Proses Pesanan
                        </button>
                        <button id="holdOrder"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-pause mr-2"></i>
                            Tahan Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal Proses Pembayaran -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4 overflow-y-auto">
            <div class="bg-white rounded-xl max-w-md w-full p-6 modal-enter my-8 max-h-[90vh] overflow-y-auto">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cash-register text-2xl text-emerald-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Proses Pembayaran</h3>
                    <p class="text-gray-600 mt-2">Masukkan jumlah uang dari customer</p>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h4>
                    <div class="space-y-2 text-sm">
                        {{-- <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium" id="modalSubtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pajak (10%):</span>
                            <span class="font-medium" id="modalTax">Rp 0</span>
                        </div> --}}
                        <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-300">
                            <span>Total Bayar:</span>
                            <span class="text-emerald-600" id="modalTotal">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Input -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Uang Customer <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-gray-500 font-medium">Rp</span>
                        <input type="text" id="customerMoney" min="0" step="1000" placeholder="0"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 currency-input transition duration-200"
                            autocomplete="off">
                    </div>
                </div>

                <!-- Change Calculation -->
                <div id="changeSection" class="mb-6 p-4 rounded-lg border-2 hidden">
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Kembalian</h4>
                        <div id="changeAmount" class="text-3xl font-bold text-blue-600 mb-2">Rp 0</div>
                        <div id="changeStatus" class="text-sm"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 sticky bottom-0 bg-white pt-4 border-t border-gray-100">
                    <button type="button" id="cancelPayment"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>
                    <button type="button" id="confirmPayment"
                        class="flex-1 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg transition duration-200 font-medium"
                        disabled>
                        <i class="fas fa-check mr-2"></i>
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>


    @extends('menu.script')
@endsection
