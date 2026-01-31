<div class="flex flex-col h-full py-6 px-4">
    <div class="flex flex-col items-center px-4 mb-10">
        <a href="{{ route('dashboard') }}" class="mb-4">
            <x-application-logo class="w-16 h-16 fill-current text-blue-400" />
        </a>
        <div class="text-center">
            <h2 class="text-white font-bold text-lg leading-tight">SiagaBencana</h2>
            <p class="text-slate-400 text-[10px] uppercase tracking-tighter">Aceh Mitigation Platform</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1">
        <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Main Menu</p>
        
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="sidebar-link">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            {{ __('Dashboard') }}
        </x-nav-link>

        <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-6 mb-2">Content Manager</p>

        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="sidebar-link">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            {{ __('Kategori') }}
        </x-nav-link>

        <x-nav-link :href="route('topics.index')" :active="request()->routeIs('topics.*')" class="sidebar-link">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
            {{ __('Topik') }}
        </x-nav-link>

        <x-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.*')" class="sidebar-link">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            {{ __('Video Edukasi') }}
        </x-nav-link>

        <x-nav-link :href="route('modules.index')" :active="request()->routeIs('modules.*')" class="sidebar-link">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            {{ __('Modul Belajar') }}
        </x-nav-link>
    </nav>

    <div class="mt-auto border-t border-slate-800 pt-6">
        <div class="flex items-center px-3 mb-4">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
            <div class="ml-3 overflow-hidden">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        
        <div class="space-y-1">
            <x-nav-link :href="route('profile.edit')" class="sidebar-link-secondary">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                {{ __('Profile Settings') }}
            </x-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-900/30 hover:text-red-300 rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    {{ __('Sign Out') }}
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .sidebar-link {
        display: flex;
        align-items: center; /* Perbaikan: Gunakan properti CSS murni */
        padding: 0.75rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.2s;
        color: #94a3b8;
        border: none !important;
    }
    .sidebar-link:hover {
        background-color: #1e293b;
        color: #ffffff;
    }
    .sidebar-link[aria-current="page"], 
    .sidebar-link.active {
        background-color: #3b82f6;
        color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .sidebar-link-secondary {
        display: flex;
        align-items: center; /* Perbaikan: Gunakan properti CSS murni */
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        border-radius: 0.5rem;
        color: #94a3b8;
        transition: all 0.2s;
        border: none !important;
    }
    .sidebar-link-secondary:hover {
        color: #ffffff;
    }
</style>