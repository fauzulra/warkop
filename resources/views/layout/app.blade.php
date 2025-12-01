<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-100">

    <!-- TOGGLE BUTTON SIDEBAR - Hanya muncul di layar mobile -->
    @include('layout.sidebar')

    <!-- MAIN CONTENT AREA - dengan margin left untuk memberikan ruang sidebar -->
    <div class="min-h-screen sm:ml-64">
        <!-- TOPBAR -->
        @include('layout.header')
        <!-- MAIN CONTENT -->
        <main class="bg-gray-50 overflow-hidden">
            @yield('content')
        </main>
        <footer class="sticky-footer bg-gray-50 border-t border-gray-200">
            <div class="container mx-auto py-6 px-4">
                <div class="flex flex-col md:flex-row items-center justify-center">
                    <!-- Left Section - Brand -->
                    <div class="flex items-center space-x-3 mb-4 md:mb-0">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-coffee text-amber-800 text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-800 font-bold text-lg">&copy; Warkop Tjemara</h3>
                            <p class="text-gray-600 text-xs">Kopi & Kuliner Nusantara</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>
