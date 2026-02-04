<div class="sticky top-20 z-40 -mt-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white/80 backdrop-blur-xl border border-white/40 shadow-xl rounded-full p-2 flex items-center justify-between transition-all duration-300 hover:bg-white/90 hover:shadow-2xl hover:scale-[1.01]">
            
            {{-- Tabs Navigation (Pill Shape) --}}
            <div class="flex p-1 bg-slate-100/50 rounded-full">
                <button @click="activeTab = 'video'" 
                        :class="activeTab === 'video' ? 'bg-white text-blue-600 shadow-md ring-1 ring-black/5' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center gap-2 px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Video
                </button>
                <button @click="activeTab = 'modul'" 
                        :class="activeTab === 'modul' ? 'bg-white text-blue-600 shadow-md ring-1 ring-black/5' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center gap-2 px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Modul
                </button>
            </div>

            {{-- Search Bar (Hidden on Mobile) --}}
            <form method="GET" action="{{ route('user.hub', $category->slug) }}" class="hidden md:block flex-1 ml-4">
                <div class="relative group">
                    <input type="text" name="search" value="{{ $search }}" 
                           class="w-full pl-5 pr-10 py-2.5 rounded-full border-0 bg-transparent text-sm font-medium focus:ring-0 placeholder-slate-400 group-hover:placeholder-blue-400 transition"
                           placeholder="Cari materi belajar...">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-slate-400 hover:text-blue-600 bg-slate-100 hover:bg-blue-50 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>