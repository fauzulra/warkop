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
                            <p class="text-3xl font-bold mb-2">Rp 4.2M</p>
                            <div class="flex items-center space-x-2">
                                <span
                                    class="bg-green-400 text-green-900 px-2 py-1 rounded-full text-xs font-semibold">+8.5%</span>
                                <span class="text-white text-opacity-70 text-xs">vs yesterday</span>
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
                    <div
                        class="glass-effect rounded-xl p-4 text-white hover:scale-105 transform transition-all duration-300">
                        <div class="text-center">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-20 rounded-full mx-auto mb-2 flex items-center justify-center">
                                {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                </svg> --}}
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
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
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
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
    <!-- Main Content Area -->
    <div class="grid grid-cols-12 px-6 pt-4 pb-12 gap-3">
        <!-- Recent Orders  -->
        <div class="col-span-12 md:col-span-6 lg:col-span-8">
            <div class="bg-white shadow rounded-2xl h-full">
                <div class=" gradient-bg-7 px-6 py-4 border-b rounded-t-2xl border-gray-200">
                    <h3 class="text-lg font-medium text-white">Recent Orders</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-100 rounded-lg">
                            <div class="flex items-center space-x-4 flex-1">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Nasi Gudeg + Es Teh</p>
                                    <p class="text-sm text-gray-500">Table 5 • 10:30 AM</p>
                                </div>
                            </div>
                            <div class="text-right min-w-[80px]">
                                <p class="text-sm font-medium text-gray-900">Rp 25,000</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-100 rounded-lg">
                            <div class="flex items-center space-x-4 flex-1">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Kopi Tubruk + Pisang</p>
                                    <p class="text-sm text-gray-500">Table 2 • 11:15 AM</p>
                                </div>
                            </div>
                            <div class="text-right min-w-[80px]">
                                <p class="text-sm font-medium text-gray-900">Rp 18,000</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-100 rounded-lg">
                            <div class="flex items-center space-x-4 flex-1">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Soto Ayam + Es Jeruk</p>
                                    <p class="text-sm text-gray-500">Table 8 • 11:45 AM</p>
                                </div>
                            </div>
                            <div class="text-right min-w-[80px]">
                                <p class="text-sm font-medium text-gray-900">Rp 32,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Actions  -->
        <div class="col-span-12 md:col-span-12 lg:col-span-4">
            <div class="bg-white shadow rounded-2xl h-full">
                <div class=" gradient-bg-7 px-6 py-4 border-b rounded-t-2xl border-gray-200">
                    <h3 class="text-lg font-medium text-white">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <button
                            class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Order
                        </button>

                        <button
                            class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            View Menu
                        </button>

                        <button
                            class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Daily Report
                        </button>

                        <button
                            class="w-full flex items-center justify-center px-4 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
