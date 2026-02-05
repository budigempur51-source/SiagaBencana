<div class="flex flex-col h-full bg-slate-900 text-white relative">
    
    {{-- TOMBOL CLOSE (Hanya Muncul di Mobile/md:hidden) --}}
    <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-slate-400 hover:text-white md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    {{-- LOGO & BRANDING --}}
    <div class="flex flex-col items-center px-6 pt-8 pb-8">
        {{-- Logo Inisial 'SB' --}}
        <div class="mb-4 w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl border border-blue-400/30 shadow-lg shadow-blue-900/50 flex items-center justify-center cursor-default select-none group hover:scale-105 transition duration-300">
            <span class="text-xl font-black text-white tracking-tighter group-hover:animate-pulse">SB</span>
        </div>
        
        {{-- Text Branding --}}
        <div class="text-center flex flex-col gap-1">
            <h2 class="text-white font-extrabold text-lg tracking-tight leading-none">
                SiagaBencana
            </h2>
            <div class="h-0.5 w-8 bg-blue-500/50 mx-auto my-1 rounded-full"></div>
            <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest text-opacity-80">
                Admin Panel
            </p>
        </div>
    </div>

    {{-- SCROLLABLE MENU AREA --}}
    <div class="flex-1 overflow-y-auto px-4 space-y-2 custom-scrollbar">
        <p class="px-2 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-2 mt-2">Main Menu</p>
        
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="sidebar-link group">
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-blue-500/20 text-slate-400 group-hover:text-blue-400 transition mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </div>
            <span class="font-medium">{{ __('Dashboard') }}</span>
        </x-nav-link>

        <p class="px-2 text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mt-6 mb-2">Content Manager</p>

        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="sidebar-link group">
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-purple-500/20 text-slate-400 group-hover:text-purple-400 transition mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
            </div>
            <span class="font-medium">{{ __('Kategori') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('topics.index')" :active="request()->routeIs('topics.*')" class="sidebar-link group">
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-pink-500/20 text-slate-400 group-hover:text-pink-400 transition mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <span class="font-medium">{{ __('Topik') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.*')" class="sidebar-link group">
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-red-500/20 text-slate-400 group-hover:text-red-400 transition mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="font-medium">{{ __('Video Edukasi') }}</span>
        </x-nav-link>

        <x-nav-link :href="route('modules.index')" :active="request()->routeIs('modules.*')" class="sidebar-link group">
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-emerald-500/20 text-slate-400 group-hover:text-emerald-400 transition mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span class="font-medium">{{ __('Modul Belajar') }}</span>
        </x-nav-link>
    </div>

    {{-- FOOTER PROFILE --}}
    <div class="mt-auto border-t border-slate-800 p-4 bg-slate-900 z-10">
        <div class="flex items-center gap-3 mb-3 p-2 rounded-xl bg-slate-800/50 border border-slate-700/50">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center font-bold text-white text-xs shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 truncate">Administrator</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-3 py-2 text-xs font-bold uppercase tracking-wider text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-lg transition-all duration-200 border border-transparent hover:border-red-500/20 group">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sign Out
            </button>
        </form>
    </div>
</div>

<style>
    /* Custom Sidebar Styles */
    .sidebar-link {
        display: flex; align-items: center; padding: 0.75rem 1rem;
        font-size: 0.875rem; border-radius: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #94a3b8; border: 1px solid transparent;
    }
    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.03);
        color: #f8fafc;
        border-color: rgba(255, 255, 255, 0.05);
        transform: translateX(4px);
    }
    .sidebar-link[aria-current="page"], .sidebar-link.active {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
        color: #60a5fa !important;
        border: 1px solid rgba(59, 130, 246, 0.2);
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.1);
    }
    .sidebar-link.active svg { color: #60a5fa; }
    
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
</style>