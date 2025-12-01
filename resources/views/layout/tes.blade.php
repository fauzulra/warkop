<div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 shadow-2xl">
    <div class="p-6">
        <div class="flex flex-col xl:flex-row gap-6">
            <!-- Left Side: Filter & Search Controls -->
            <div class="flex-1">
                <div class="space-y-4">
                    <!-- Search Input with enhanced styling -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-white/60"></i>
                        </div>
                        <input type="text" id="searchInput"
                            class="block w-full pl-12 pr-4 py-4 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/70 focus:ring-4 focus:ring-white/25 focus:border-white/50 transition-all duration-300"
                            placeholder="Cari nama item, kode, atau kategori...">
                    </div>

                    <!-- Filter Controls Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Category Filter -->
                        <div>
                            <select
                                class="w-full px-4 py-4 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white focus:ring-4 focus:ring-white/25 focus:border-white/50 transition-all duration-300">
                                <option value="" class="text-gray-900">Semua Kategori</option>
                                <option value="elektronik" class="text-gray-900">Elektronik</option>
                                <option value="furniture" class="text-gray-900">Furniture</option>
                                <option value="alat-tulis" class="text-gray-900">Alat Tulis</option>
                                <option value="peralatan" class="text-gray-900">Peralatan</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <select
                                class="w-full px-4 py-4 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white focus:ring-4 focus:ring-white/25 focus:border-white/50 transition-all duration-300">
                                <option value="" class="text-gray-900">Semua Status</option>
                                <option value="tersedia" class="text-gray-900">Tersedia</option>
                                <option value="stok-rendah" class="text-gray-900">Stok Rendah</option>
                                <option value="habis" class="text-gray-900">Habis</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <div class="sm:col-span-2 lg:col-span-1">
                            <button
                                class="w-full px-4 py-4 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white rounded-xl transition-all duration-300 flex items-center justify-center border border-white/30 hover:border-white/50">
                                <i class="fas fa-redo mr-2"></i>
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Action Buttons -->
            <div class="xl:w-[220px] flex flex-col justify-center">
                <div class="space-y-3">
                    <button
                        class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-6 py-4 rounded-xl transition-all duration-300 flex items-center justify-center font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Item
                    </button>
                    <button
                        class="w-full bg-gradient-to-r from-orange-500 to-pink-600 hover:from-orange-600 hover:to-pink-700 text-white px-6 py-4 rounded-xl transition-all duration-300 flex items-center justify-center font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-download mr-2"></i>
                        Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- <div class="gradient-bg rounded-3xl shadow-2xl p-8 border">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <span class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">1</span>
            Modern Chart Dashboard
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Revenue Overview</h3>
                    <div class="flex space-x-2">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">+15.2%</span>
                    </div>
                </div>
                <canvas id="revenueChart" class="w-full max-h-64 glass-effect"></canvas>
            </div>

            <!-- Key Metrics -->
            <div class="space-y-4">
                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Orders</p>
                            <p class="text-2xl font-bold text-gray-900">2,847</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Revenue</p>
                            <p class="text-2xl font-bold text-gray-900">Rp 4.2M</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Avg. Order</p>
                            <p class="text-2xl font-bold text-gray-900">Rp 27K</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

<!-- Option 2: Glassmorphism Style -->
{{-- <div class="gradient-bg rounded-3xl shadow-2xl p-8">
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
            <span
                class="bg-white text-purple-600 rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm font-bold">2</span>
            Glassmorphism Dashboard
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="glass-effect rounded-2xl p-6 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-2 bg-white bg-opacity-30 rounded-full overflow-hidden">
                            <div class="w-12 h-full bg-white rounded-full"></div>
                        </div>
                    </div>
                </div>
                <p class="text-sm opacity-80 mb-1">Total Orders</p>
                <p class="text-3xl font-bold">2,847</p>
                <p class="text-xs opacity-70 mt-2">↗ +12% vs yesterday</p>
            </div>

            <div class="glass-effect rounded-2xl p-6 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-2 bg-white bg-opacity-30 rounded-full overflow-hidden">
                            <div class="w-14 h-full bg-green-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
                <p class="text-sm opacity-80 mb-1">Revenue</p>
                <p class="text-3xl font-bold">Rp 4.2M</p>
                <p class="text-xs opacity-70 mt-2">↗ +8.5% vs yesterday</p>
            </div>

            <div class="glass-effect rounded-2xl p-6 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-2 bg-white bg-opacity-30 rounded-full overflow-hidden">
                            <div class="w-10 h-full bg-yellow-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
                <p class="text-sm opacity-80 mb-1">Menu Items</p>
                <p class="text-3xl font-bold">156</p>
                <p class="text-xs opacity-70 mt-2">→ +3 new items</p>
            </div>

            <div class="glass-effect rounded-2xl p-6 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-2 bg-white bg-opacity-30 rounded-full overflow-hidden">
                            <div class="w-11 h-full bg-red-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
                <p class="text-sm opacity-80 mb-1">Avg. Order Value</p>
                <p class="text-3xl font-bold">Rp 27K</p>
                <p class="text-xs opacity-70 mt-2">↗ +5.2% vs yesterday</p>
            </div>
        </div>
    </div> --}}

<!-- Option 4: Minimal Analytics -->
{{-- <div class="bg-white rounded-3xl shadow-2xl p-8 border">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <span
                class="bg-purple-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">4</span>
            Minimal Analytics Dashboard
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Analytics Chart -->
            <div class="lg:col-span-3 bg-gray-50 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Weekly Performance</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm">7D</button>
                        <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded-lg text-sm">30D</button>
                    </div>
                </div>
                <canvas id="weeklyChart" class="w-full max-h-64"></canvas>
            </div>

            <!-- Quick Stats -->
            <div class="lg:col-span-2 space-y-4">
                <div class="text-center p-6 bg-blue-50 rounded-xl border-2 border-blue-100">
                    <div class="text-3xl font-bold text-blue-600 mb-2">2,847</div>
                    <div class="text-sm text-blue-700 font-medium">Total Orders</div>
                    <div class="text-xs text-blue-500 mt-1">+12% from yesterday</div>
                </div>

                <div class="text-center p-6 bg-green-50 rounded-xl border-2 border-green-100">
                    <div class="text-3xl font-bold text-green-600 mb-2">4.2M</div>
                    <div class="text-sm text-green-700 font-medium">Revenue (Rp)</div>
                    <div class="text-xs text-green-500 mt-1">+8.5% from yesterday</div>
                </div>

                <div class="text-center p-6 bg-orange-50 rounded-xl border-2 border-orange-100">
                    <div class="text-3xl font-bold text-orange-600 mb-2">27K</div>
                    <div class="text-sm text-orange-700 font-medium">Avg. Order (Rp)</div>
                    <div class="text-xs text-orange-500 mt-1">+5.2% from yesterday</div>
                </div>
            </div>
        </div>
    </div> --}}

<!-- Selection Guide -->
{{-- <div class="bg-gray-900 text-white rounded-3xl p-8">
        <h2 class="text-2xl font-bold mb-6">Pilihan Rekomendasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                    1</div>
                <h3 class="font-semibold mb-2">Modern Chart</h3>
                <p class="text-sm text-gray-300">Cocok untuk analisis mendalam dengan chart interaktif</p>
            </div>
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                    2</div>
                <h3 class="font-semibold mb-2">Glassmorphism</h3>
                <p class="text-sm text-gray-300">Tampilan modern dan elegan dengan efek kaca</p>
            </div>
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-green-500 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                    3</div>
                <h3 class="font-semibold mb-2">Interactive</h3>
                <p class="text-sm text-gray-300">Kombinasi metrics dan top sellers yang interaktif</p>
            </div>
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-orange-500 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                    4</div>
                <h3 class="font-semibold mb-2">Minimal</h3>
                <p class="text-sm text-gray-300">Desain clean dan minimalis dengan focus pada data</p>
            </div>
        </div>
    </div> --}}
{{-- <!-- Stats Cards -->
    <div class="grid grid-cols-12 px-6 md:grid-cols-2  lg:grid-cols-4 gap-5 mb-8">
        <div
            class="bg-white overflow-hidden shadow rounded-lg p-6 transform transition-all hover:bg-[#fcf4ff] hover:-translate-y-2 hover:shadow-[4px_4px_0_#000] duration-400">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-7 w-7 text-indigo-600 mr-5" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                </div>
                <div class="">

                    <p class="text-sm font-medium text-gray-500">Order Harian</p>
                    <p class="text-2xl font-semibold text-gray-900">2,847</p>
                </div>
            </div>
        </div>
        <div
            class="bg-white overflow-hidden shadow rounded-lg p-6 transform transition-all hover:bg-[#fcf4ff] hover:-translate-y-2 hover:shadow-[4px_4px_0_#000] duration-400">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-7 w-7  mr-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <div class="">
                    <p class="text-sm font-medium text-gray-500">Pendapatan Harian</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp 4.2M</p>
                </div>
            </div>
        </div>
        <div
            class="bg-white overflow-hidden shadow rounded-lg p-6 justify-center transform transition-all hover:bg-[#fcf4ff] hover:-translate-y-2 hover:shadow-[4px_4px_0_#000] duration-400">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-7 w-7 mr-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 7a2 2 0 012-2h10a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="">
                    <p class="text-sm font-medium text-gray-500">Order Harian</p>
                    <p class="text-2xl font-semibold text-gray-900">156</p>
                </div>
            </div>
        </div>
        <div
            class="bg-white overflow-hidden shadow rounded-lg p-6 transform transition-all hover:bg-[#fcf4ff] hover:-translate-y-2 hover:shadow-[4px_4px_0_#000] duration-400">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-7 w-7  mr-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="">
                    <p class="text-sm font-medium text-gray-500">Avg. Order Value</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp 27K</p>
                </div>
            </div>
        </div>
    </div> --}}
<!-- Page Header -->
<div class="p-6 mb-2">
    <h2 class="text-2xl font-bold text-gray-900">Welcome to Warkop Tjemara</h2>
    <p class="mt-1 text-sm text-gray-600">Here's what's happening with your business today.</p>
</div>
<!-- Option 3: Interactive Metric Cards -->
<div class="gradient-bg-1 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gradient-bg-2 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gradient-bg-3 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gradient-bg-4 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gradient-bg-5 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gradient-bg-6 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side - Main Metrics -->
        <div class="space-y-4">
            <!-- Main Revenue Card -->
            <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                        <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                            <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two smaller cards -->
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">2,847</p>
                        <p class="text-sm text-white text-opacity-80">Orders Today</p>
                    </div>
                </div>

                <div
                    class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-white">Rp 27K</p>
                        <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Popular Items -->
        <div class="glass-card rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
            <div class="space-y-2">
                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            1</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                            <p class="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            2</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                            <p class="text-xs text-gray-500">38 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            3</div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                            <p class="text-xs text-gray-500">32 orders</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 {{-- <div class="gradient-bg-8 rounded-2xl shadow-xl p-6 mb-8 my-6 mx-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Side - Main Metrics -->
            <div class="space-y-4">
                <!-- Main Revenue Card -->
                <div class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white text-opacity-80 text-sm mb-1">Today's Revenue</p>
                            <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                            <div class="flex items-center space-x-2">
                                <span
                                    class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                                <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Two smaller cards -->
                <div class="grid grid-cols-2 gap-3">
                    <div
                        class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-white">2,847</p>
                            <p class="text-sm text-white text-opacity-80">Orders Today</p>
                        </div>
                    </div>

                    <div
                        class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-white">Rp 27K</p>
                            <p class="text-sm text-white text-opacity-80">Avg. Order</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Popular Items -->
            <div class="glass-card rounded-xl p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Top Sellers Today</h3>
                <div class="space-y-2">
                    <div
                        class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                1</div>
                            <div>
                                <p class="font-medium text-gray-900 text-sm">Nasi Gudeg</p>
                                <p class="text-xs text-gray-500">45 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900 text-sm">Rp 15K</p>
                            <p class="text-xs text-green-600">+12%</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                2</div>
                            <div>
                                <p class="font-medium text-gray-900 text-sm">Kopi Tubruk</p>
                                <p class="text-xs text-gray-500">38 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900 text-sm">Rp 8K</p>
                            <p class="text-xs text-green-600">+8%</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between bg-white bg-opacity-70 p-3 rounded-lg shadow-sm hover:bg-opacity-90 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                3</div>
                            <div>
                                <p class="font-medium text-gray-900 text-sm">Soto Ayam</p>
                                <p class="text-xs text-gray-500">32 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900 text-sm">Rp 20K</p>
                            <p class="text-xs text-green-600">+15%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="bg-white rounded-3xl shadow-2xl p-8 border">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <span
                class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-sm">3</span>
            Interactive Metric Dashboard
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Side - Main Metrics -->
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white neon-glow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm mb-2">Today's Revenue</p>
                            <p class="text-4xl font-bold mb-2">Rp 4.2M</p>
                            <div class="flex items-center space-x-2">
                                <span
                                    class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                                <span class="text-blue-100 text-xs">vs yesterday</span>
                            </div>
                        </div>
                        <div class="w-20 h-20 bg-blue-400 bg-opacity-30 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h4a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h4a1 1 0 011 1v12a1 1 0 01-1 1h-4a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="bg-green-50 border-2 border-green-200 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-500 rounded-full mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-900">2,847</p>
                            <p class="text-sm text-gray-600">Orders Today</p>
                        </div>
                    </div>

                    <div
                        class="bg-purple-50 border-2 border-purple-200 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-500 rounded-full mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-900">Rp 27K</p>
                            <p class="text-sm text-gray-600">Avg. Order</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Popular Items -->
            <div class="bg-gray-50 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Sellers Today</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between bg-white p-3 rounded-lg shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                1</div>
                            <div>
                                <p class="font-medium text-gray-900">Nasi Gudeg</p>
                                <p class="text-sm text-gray-500">45 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">Rp 15K</p>
                            <p class="text-sm text-green-600">+12%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-white p-3 rounded-lg shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                2</div>
                            <div>
                                <p class="font-medium text-gray-900">Kopi Tubruk</p>
                                <p class="text-sm text-gray-500">38 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">Rp 8K</p>
                            <p class="text-sm text-green-600">+8%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-white p-3 rounded-lg shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                3</div>
                            <div>
                                <p class="font-medium text-gray-900">Soto Ayam</p>
                                <p class="text-sm text-gray-500">32 orders</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">Rp 20K</p>
                            <p class="text-sm text-green-600">+15%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}