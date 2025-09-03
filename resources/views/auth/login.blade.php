<x-guest-layout>
    {{-- CSS untuk animasi zoom-in --}}
    <style>
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-zoom-in {
            animation: zoomIn 0.5s ease-out forwards;
        }

           /* ... (kode keyframes zoomIn kamu) ... */

    /* CSS untuk Bentuk Mengambang */
    .background-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Penting agar berada di belakang konten */
        overflow: hidden;
    }

    .background-shapes span {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.1); /* Warna bentuk */
        animation: floatUp 25s linear infinite;
        bottom: -150px; /* Posisi awal di luar layar */
        border-radius: 50%; /* Membuatnya menjadi lingkaran */
    }

    /* Variasi ukuran, posisi, dan kecepatan untuk setiap bentuk */
    .background-shapes span:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
    .background-shapes span:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
    .background-shapes span:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
    .background-shapes span:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
    .background-shapes span:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
    .background-shapes span:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
    .background-shapes span:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
    .background-shapes span:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }

    @keyframes floatUp {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) rotate(720deg);
            opacity: 0;
        }
    }
    </style>
 {{-- TAMBAHKAN KODE BENTUK DI SINI --}}
    <div class="background-shapes">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    {{-- Div pembungkus untuk menerapkan animasi --}}
    <div class="animate-zoom-in">

        {{-- LOGO SEKARANG DITAMBAHKAN DI SINI --}}
        <div class="flex justify-center mb-6">
            <a href="/">
                <x-application-logo class="w-40 fill-current text-gray-500" />
            </a>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                @endif

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-4" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-4">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>