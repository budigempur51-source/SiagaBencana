<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - SiagaBencana Aceh</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white">

    <div class="min-h-screen flex">
        
        {{-- BAGIAN KIRI: Visual & Branding (Hidden di Mobile) --}}
        <div class="hidden lg:flex w-1/2 bg-slate-900 relative overflow-hidden items-center justify-center">
            {{-- Background Image --}}
            <div class="absolute inset-0 opacity-40 bg-[url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/90 to-emerald-900/80"></div>

            <div class="relative z-10 max-w-lg px-10 text-white">
                <a href="/" class="flex items-center gap-3 mb-8">
                    <img src="{{ asset('avatar/logoweb.png') }}" class="h-12 w-auto brightness-200" alt="Logo">
                    <div class="flex flex-col">
                        <span class="text-2xl font-black uppercase tracking-tight">SiagaBencana</span>
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Aceh Digilitera</span>
                    </div>
                </a>
                <h1 class="text-4xl font-extrabold leading-tight mb-6">Membangun Generasi Aceh yang Tangguh Bencana.</h1>
                <p class="text-lg text-slate-300 leading-relaxed mb-8">
                    "Bergabunglah dengan ribuan masyarakat Aceh lainnya dalam platform edukasi mitigasi bencana pertama yang berbasis budaya lokal."
                </p>
                
                {{-- Feature List --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="font-medium text-slate-200">Akses Video Edukasi Gratis</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="font-medium text-slate-200">Modul Bacaan Lengkap</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: Form Pendaftaran --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="max-w-md w-full">
                <div class="text-center lg:text-left mb-10">
                    <h2 class="text-3xl font-black text-slate-900">Buat Akun Baru</h2>
                    <p class="text-slate-500 mt-2">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a></p>
                </div>

                {{-- SOCIAL BUTTONS --}}
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center gap-2 py-3 px-4 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition group">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">Google</span>
                    </a>
                    <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center gap-2 py-3 px-4 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition group">
                        <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">Facebook</span>
                    </a>
                </div>

                <div class="relative flex py-2 items-center mb-6">
                    <div class="flex-grow border-t border-slate-200"></div>
                    <span class="flex-shrink-0 mx-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Atau daftar manual</span>
                    <div class="flex-grow border-t border-slate-200"></div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-bold" />
                        <x-text-input id="name" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:ring-blue-500 focus:border-blue-500 rounded-xl py-3" type="text" name="name" :value="old('name')" required autofocus placeholder="Contoh: Teuku Umar" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-bold" />
                        <x-text-input id="email" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:ring-blue-500 focus:border-blue-500 rounded-xl py-3" type="email" name="email" :value="old('email')" required placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" class="text-slate-700 font-bold" />
                        <x-text-input id="password" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:ring-blue-500 focus:border-blue-500 rounded-xl py-3" type="password" name="password" required placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-slate-700 font-bold" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full bg-slate-50 border-slate-200 focus:ring-blue-500 focus:border-blue-500 rounded-xl py-3" type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- Remember Me (Menyimpan Cookie) --}}
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember" checked>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya (Simpan Cookie)') }}</span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <x-primary-button class="w-full justify-center py-4 text-base font-bold rounded-xl shadow-lg shadow-blue-200 bg-blue-600 hover:bg-blue-700 transition">
                            {{ __('Buat Akun Sekarang') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>