@extends('layout.app')
@section('title', 'Dashboard')

@section('styles')
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .neon-glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .gradient-bg-1 {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        }

        /* Opsi 2: Sky Blue Gradient */
        .gradient-bg-2 {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }

        /* Opsi 3: Ocean Blue Gradient */
        .gradient-bg-3 {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        }

        /* Opsi 4: Deep Blue Gradient */
        .gradient-bg-4 {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }

        /* Opsi 5: Blue to Indigo */
        .gradient-bg-5 {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
        }

        /* Opsi 6: Light Blue Gradient */
        .gradient-bg-6 {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        /* Opsi 7: Navy Blue Gradient */
        .gradient-bg-7 {
            background: linear-gradient(135deg, #1e3a8a 0%, #312e81 100%);
        }

        /* Opsi 8: Blue with Teal Accent */
        .gradient-bg-8 {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        }
    </style>
@endsection
@section('content')
    {{-- Stats Area --}}
    <div class="gradient-bg-7 rounded-2xl shadow-xl p-6 mb-4 my-6 mx-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Side - Main Metrics -->
            <div class="space-y-4">
                <!-- Main Revenue Card -->
                <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                            <!-- Menampilkan revenue dengan format M/K dinamis -->
                            <p class="text-3xl font-bold mb-2">Rp {{ $todayRevenue }}</p>

                            @php
                                // Menghitung selisih persentase dan membulatkannya
                                $percentage = 0;
                                if ($yesterdayRevenueRaw > 0) {
                                    $percentage = round(
                                        abs(($todayRevenueRaw - $yesterdayRevenueRaw) / $yesterdayRevenueRaw) * 100,
                                    );
                                } elseif ($todayRevenueRaw > 0) {
                                    $percentage = 100; // Jika kemarin 0 dan hari ini ada pemasukan
                                }
                            @endphp

                            <div class="flex items-center space-x-2">
                                @if ($todayRevenueRaw > $yesterdayRevenueRaw)
                                    <span
                                        class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+{{ $percentage }}%</span>
                                @elseif($todayRevenueRaw < $yesterdayRevenueRaw)
                                    <span
                                        class="bg-red-400 text-red-900 px-2 py-1 rounded-full text-xs font-semibold">-{{ $percentage }}%</span>
                                @else
                                    <span
                                        class="bg-gray-400 text-gray-900 px-2 py-1 rounded-full text-xs font-semibold">0%</span>
                                @endif
                                <span class="text-white text-opacity-70 text-xs">vs kemarin</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15v4m6-6v6m6-4v4m6-6v6M3 11l6-5 6 5 5.5-5.5" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Two smaller cards -->
                <div class="grid grid-cols-2 gap-3">

                    <!-- Orders Today Card -->
                    <div
                        class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <!-- Menampilkan jumlah order hari ini -->
                            <p class="text-2xl font-bold text-white">{{ number_format($ordersToday, 0, ',', '.') }}</p>
                            <p class="text-sm text-white text-opacity-80">Orders Today</p>
                        </div>
                    </div>

                    <!-- Avg Order Card -->
                    <div
                        class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                </svg>
                            </div>
                            <!-- Menampilkan rata-rata pesanan format K/M -->
                            <p class="text-2xl font-bold text-white">Rp {{ $avgOrderWeek }}</p>
                            <p class="text-sm text-white text-opacity-80">Avg. Revenue</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Side - Popular Items -->
            <div class="glass-card rounded-xl p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers (7 Hari Terakhir)</h3>
                <div class="space-y-2">
                    @forelse($topSellers as $index => $seller)
                        @php
                            // Tentukan warna badge berdasarkan urutan (1: Merah, 2: Oranye, 3: Kuning)
                            $badgeColors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500'];
                            $colorClass = $badgeColors[$index] ?? 'bg-gray-500';
                        @endphp

                        <div
                            class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="{{ $colorClass }} w-7 h-7 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <!-- UBAH BAGIAN INI: Langsung panggil menu_name -->
                                    <p class="font-medium text-gray-900 text-sm">
                                        {{ $seller->menu_name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $seller->total_orders }} orders
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <!-- UBAH BAGIAN INI: Langsung panggil menu_price -->
                                <p class="font-semibold text-gray-900 text-sm">
                                    Rp {{ number_format($seller->menu_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3 text-sm text-gray-500">
                            Belum ada penjualan minggu ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Area -->
    <div class="grid grid-cols-12 px-6 pt-4 pb-12 gap-3">
        <!-- Recent Orders  -->
        <div class="col-span-12 md:col-span-6 lg:col-span-8">
            <div class="bg-white shadow rounded-2xl h-full">
                <div class="gradient-bg-7 px-6 py-4 border-b rounded-t-2xl border-gray-200">
                    <h3 class="text-lg font-medium text-white">Recent Orders</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($recentOrders as $order)
                            @php
                                // Menggabungkan semua nama menu dalam satu transaksi dengan pemisah " + "
                                // Contoh hasil: "Nasi Gudeg + Es Teh"
                                $menuNames = $order->items
                                    ->map(function ($item) {
                                        return $item->menu->name ?? 'Menu Dihapus';
                                    })
                                    ->implode(' + ');
                            @endphp

                            <div
                                class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                <div class="flex items-center space-x-4 flex-1">
                                    <div>
                                        <!-- Menampilkan nama-nama menu -->
                                        <p class="text-sm font-medium text-gray-900 truncate max-w-[200px] md:max-w-[300px]"
                                            title="{{ $menuNames }}">
                                            {{ $menuNames }}
                                        </p>
                                        <!-- Menampilkan Invoice & Waktu Transaksi -->
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            {{ $order->invoice_number }} • {{ $order->created_at->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right min-w-[80px]">
                                    <!-- Menampilkan Total Harga -->
                                    <p class="text-sm font-bold text-gray-900">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </p>
                                    <!-- Opsional: Menampilkan Status -->
                                    <p
                                        class="text-[10px] uppercase font-semibold {{ $order->status === 'selesai' ? 'text-green-600' : 'text-orange-500' }}">
                                        {{ $order->status }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-sm text-gray-500 bg-gray-50 rounded-lg">
                                Belum ada transaksi masuk.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Actions  -->
        <div class="col-span-12 md:col-span-12 lg:col-span-4">
            <div class="bg-white shadow rounded-2xl h-full">
                <div class="gradient-bg-7 px-6 py-4 border-b rounded-t-2xl border-gray-200">
                    <h3 class="text-lg font-medium text-white">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- New Order -> Arahkan ke menu.index -->
                        <a href="{{ route('menu.index') }}"
                            class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Order
                        </a>

                        <!-- View Menu -> Arahkan ke menu.index -->
                        <a href="{{ route('menu.create') }}"
                            class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Add New Menu
                        </a>

                        <!-- Daily Report -> Hanya tampil untuk Admin -->
                        @role('admin')
                            <a href="{{ route('transaksi.index') }}"
                                class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Daily Report
                            </a>
                        @endrole

                        <!-- Data Inventaris -> Arahkan ke inventaris.index -->
                        <a href="{{ route('inventaris.index') }}"
                            class="w-full flex items-center justify-center px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            View Inventory
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
