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
            <!-- Notifications -->
            <button type="button"
                class="relative inline-flex items-center p-2 text-sm font-medium text-center text-white bg-black mr-5 rounded-full hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 16">
                    <path
                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                    <path
                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                </svg>
                <span class="sr-only">Notifications</span>
                <div
                    class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-blue-800 bg-blue-100 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                    20</div>
            </button>

            <!-- Profile -->
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="User avatar">
                <span class="ml-2 text-gray-700 hidden md:block">John Doe</span>
            </div>
        </div>
    </div>
</header>
