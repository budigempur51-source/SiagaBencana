<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBencana') }} - Admin Panel</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900" x-data="{ sidebarOpen: false }">
    
    <div class="flex h-screen overflow-hidden">
        
        {{-- 1. OVERLAY GELAP (Cuma muncul di Mobile pas sidebar buka) --}}
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm md:hidden"
             style="display: none;">
        </div>

        {{-- 2. SIDEBAR NAVIGATION --}}
        {{-- 
            PERBAIKAN LOGIKA:
            - Default (Mobile): '-translate-x-full' (Ngumpet ke kiri layar).
            - md: (Tablet/Laptop): 'md:translate-x-0' (Muncul) dan 'md:static' (Diam di tempat).
            - Alpine (:class): Cuma ngatur buka-tutup di HP. Tidak akan ganggu tampilan Laptop.
        --}}
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col shrink-0">
             
             @include('layouts.navigation')
             
        </div>

        {{-- 3. MAIN CONTENT WRAPPER --}}
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            
            {{-- A. MOBILE TOPBAR (Tombol Hamburger) --}}
            {{-- Ini cuma muncul di Mobile (md:hidden), di Laptop hilang. --}}
            <header class="flex items-center justify-between bg-white px-6 py-4 shadow-sm border-b border-slate-100 md:hidden sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    {{-- Tombol Buka Sidebar --}}
                    <button @click="sidebarOpen = true" class="text-slate-500 focus:outline-none hover:text-blue-600 transition p-1 rounded-md active:bg-slate-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    {{-- Logo Kecil di Header Mobile --}}
                    <span class="text-lg font-black text-slate-800 tracking-tight">SiagaBencana</span>
                </div>

                {{-- Avatar User Kecil --}}
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </header>

            {{-- B. KONTEN HALAMAN (Slot) --}}
            <main class="w-full flex-grow p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
            
        </div>
    </div>

</body>
</html>