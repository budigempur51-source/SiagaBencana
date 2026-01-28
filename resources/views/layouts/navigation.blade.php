<nav x-data="{ open: false }" class="bg-white border-r border-gray-200 w-64 min-h-screen hidden md:flex flex-col flex-shrink-0">
    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center shadow-lg shadow-red-200 group-hover:scale-110 transition-transform duration-200">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xl font-black tracking-tight text-gray-900">
                Siaga<span class="text-red-600">Bencana</span>
            </span>
        </a>
    </div>

    <div class="flex-1 py-8 px-4 space-y-2 overflow-y-auto">
        
        <div class="mb-6">
            <p class="px-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Utama</p>
            
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </x-nav-link>
        </div>

        <div class="mb-6">
            <p class="px-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Manajemen Materi</p>

            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('categories.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Kategori
            </x-nav-link>

            <x-nav-link :href="route('topics.index')" :active="request()->routeIs('topics.*')">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('topics.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"/>
                </svg>
                Topik Edukasi
            </x-nav-link>

            {{-- Menggunakan check Route::has agar tidak error sebelum controller video dibuat --}}
            <x-nav-link :href="Route::has('videos.index') ? route('videos.index') : '#'" :active="request()->routeIs('videos.*')">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('videos.*') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Database Video
            </x-nav-link>
        </div>

        <div class="mb-6">
            <p class="px-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Sistem</p>
            
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.edit') ? 'text-red-600' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Pengaturan Profil
            </x-nav-link>
        </div>
    </div>

    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="flex items-center px-4 py-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-black text-sm shadow-md mr-3 uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 mr-3 text-red-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</nav>