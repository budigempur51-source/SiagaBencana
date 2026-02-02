<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBencana') }} - Ruang Belajar</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine.js (Wajib untuk interaksi) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Stack Styles (Jika ada view yang butuh CSS khusus) --}}
    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    
    {{-- NAVBAR KHUSUS USER (Top Navigation) --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                        <img src="{{ asset('avatar/logoweb.png') }}" class="block h-9 w-auto" alt="Logo">
                        <div class="flex flex-col">
                            <span class="font-black text-slate-800 tracking-tight leading-none text-lg">SiagaBencana</span>
                            <span class="text-[9px] font-bold text-blue-600 uppercase tracking-widest leading-none">Learning Hub</span>
                        </div>
                    </a>
                    
                    {{-- Desktop Menu Links --}}
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                        <a href="{{ route('user.selection') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('user.selection') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                            Kategori
                        </a>
                        {{-- Bisa tambah menu lain disini --}}
                    </div>
                </div>

                {{-- User Profile Dropdown --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <div @click="open = ! open" class="cursor-pointer flex items-center gap-2 px-3 py-2 rounded-full hover:bg-slate-100 transition">
                            <div class="text-right hidden md:block">
                                <div class="text-xs font-bold text-slate-700">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-slate-400">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 py-1 focus:outline-none"
                             style="display: none;">
                            
                            <div class="block px-4 py-2 text-xs text-slate-400">
                                {{ __('Manage Account') }}
                            </div>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                {{ __('Profile') }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Page Content (Full Width) --}}
    <main class="pt-16 min-h-screen">
        {{ $slot }}
    </main>

    {{-- Footer Simple --}}
    <footer class="bg-white border-t border-slate-100 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-400 text-sm">&copy; {{ date('Y') }} SiagaBencana Aceh. Platform Edukasi Digital.</p>
        </div>
    </footer>

    {{-- 
        ==================================================
        CRITICAL FIX: STACK SCRIPTS
        ==================================================
        Ini wajib ada agar perintah @push('scripts') 
        dari halaman lain bisa masuk ke sini.
    --}}
    @stack('scripts')

</body>
</html>