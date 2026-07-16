<header class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-2 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <h1 class="text-xl font-semibold text-gray-900">@yield('page-title')</h1>
        </div>

        <!-- Search bar -->
        {{-- <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-start max-w-lg">
                    <div class="w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input id="search" name="search"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Search..." type="search">
                        </div>
                    </div>
                </div> --}}

        <!-- Right side items -->
        <div class="flex items-center space-x-4">

            <!-- Profile -->
            <div class="relative inline-block text-left">
                <!-- Trigger: Klik John Doe atau foto untuk membuka dropdown -->
                <button type="button" onclick="toggleProfileDropdown()"
                    class="flex items-center focus:outline-none transition-all duration-200 hover:opacity-80">
                    <div
                        class="h-8 w-8 rounded-full bg-blue-600 border border-gray-200 flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <span class="ml-2 text-gray-700 font-medium hidden md:block">{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">

                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
