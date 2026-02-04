<div class="sticky top-16 z-30 bg-white/80 backdrop-blur-lg border-b border-slate-200 shadow-sm transition-all duration-300">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            {{-- Tabs Navigation --}}
            <div class="flex space-x-8 h-full">
                <button @click="activeTab = 'video'" 
                        :class="activeTab === 'video' ? 'border-blue-600 text-blue-700' : 'border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300'"
                        class="h-full flex items-center gap-2 px-1 text-sm md:text-base font-bold border-b-[3px] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Video Pembelajaran
                </button>
                <button @click="activeTab = 'modul'" 
                        :class="activeTab === 'modul' ? 'border-blue-600 text-blue-700' : 'border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300'"
                        class="h-full flex items-center gap-2 px-1 text-sm md:text-base font-bold border-b-[3px] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Modul & Buku
                </button>
            </div>

            {{-- Search Bar --}}
            <form method="GET" action="{{ route('user.hub', $category->slug) }}" class="hidden md:block w-80 lg:w-96">
                <div class="relative group">
                    <input type="text" name="search" value="{{ $search }}" 
                           class="w-full pl-5 pr-12 py-2.5 rounded-full border border-slate-200 bg-slate-100 text-sm font-medium focus:bg-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition shadow-inner"
                           placeholder="Cari materi...">
                    <button type="submit" class="absolute right-1 top-1 h-[34px] w-[34px] flex items-center justify-center text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 rounded-full shadow-sm border border-slate-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>