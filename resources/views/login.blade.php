<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warkop Tjemara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mempertahankan style gradien dan glass effect dari dashboard */
        .gradient-bg-7 {
            background: linear-gradient(135deg, #1e3a8a 0%, #312e81 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="gradient-bg-7 min-h-screen flex items-center justify-center p-4">

    <!-- Container Utama -->
    <div class="w-full max-w-md">

        <!-- Logo / Judul -->
        <div class="text-center mb-8 transform transition-all duration-500 hover:scale-105">
            <h1 class="text-4xl font-bold text-white tracking-wider mb-2 drop-shadow-lg">WARKOP TJEMARA</h1>
            <p class="text-white text-opacity-80 font-medium tracking-wide">Sistem Informasi Manajemen</p>
        </div>

        <!-- Glass Card Login -->
        <div class="glass-card rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Welcome Back</h2>

            <!-- Pesan Error (Opsional, bawaan Laravel) -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" required autofocus
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white bg-opacity-70 transition-all duration-200 text-gray-900 shadow-sm"
                            placeholder="admin@tjemara.com">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white bg-opacity-70 transition-all duration-200 text-gray-900 shadow-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Remember
                            me</label>
                    </div>
                    <div class="text-sm">
                        <a href="#"
                            class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Forgot
                            password?</a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full flex items-center justify-center px-  4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold tracking-wide">
                    Sign In
                    <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

        </div>

        <!-- Footer -->
        <p class="text-center text-white text-opacity-60 text-sm mt-8">
            &copy; {{ date('Y') }} Warkop Tjemara. All rights reserved.
        </p>

    </div>
</body>

</html>
