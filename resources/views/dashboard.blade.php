<x-app-layout>
    {{-- EFEK BACKGROUND HALUS --}}
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-slate-900 to-slate-100 z-0"></div>

    <div class="relative z-10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- 1. HERO SECTION (Sapaan Admin) --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-10 text-white">
                <div>
                    <h2 class="text-4xl font-black tracking-tight mb-2">Dashboard Overview</h2>
                    <p class="text-slate-300">Selamat datang kembali, {{ Auth::user()->name }}. Ini ringkasan sistem hari ini.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-sm font-bold flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        System Online
                    </span>
                </div>
            </div>

            {{-- 2. STATS CARDS (Untuk 5 Fitur) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                
                <div class="bg-white rounded-[25px] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-red-50 rounded-bl-[100px] -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Video Edukasi</h3>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ \App\Models\Video::count() }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-[25px] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Modul Bacaan</h3>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ \App\Models\LearningModule::count() }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-[25px] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-purple-50 rounded-bl-[100px] -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
                        </div>
                        <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total Kategori</h3>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ \App\Models\Category::count() }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-[25px] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition duration-300">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-[100px] -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total User</h3>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>

            {{-- 3. QUICK ACTIONS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('videos.create') }}" class="group relative block h-48 bg-gradient-to-br from-red-500 to-pink-600 rounded-[30px] overflow-hidden shadow-lg hover:shadow-red-500/30 transition-all duration-300 hover:scale-[1.02]">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Upload Video</h3>
                        <p class="text-red-100 text-sm mt-1">Tambah materi visual baru</p>
                    </div>
                    {{-- Hiasan --}}
                    <svg class="absolute top-4 right-4 w-24 h-24 text-white/10 group-hover:rotate-12 transition transform" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                </a>

                <a href="{{ route('modules.create') }}" class="group relative block h-48 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-[30px] overflow-hidden shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 hover:scale-[1.02]">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Buat Modul</h3>
                        <p class="text-emerald-100 text-sm mt-1">Tambah bahan bacaan PDF</p>
                    </div>
                    {{-- Hiasan --}}
                    <svg class="absolute top-4 right-4 w-24 h-24 text-white/10 group-hover:rotate-12 transition transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </a>

                <a href="{{ route('categories.index') }}" class="group relative block h-48 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[30px] overflow-hidden shadow-lg hover:shadow-blue-600/30 transition-all duration-300 hover:scale-[1.02]">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Kategori</h3>
                        <p class="text-blue-100 text-sm mt-1">Atur struktur materi</p>
                    </div>
                    {{-- Hiasan --}}
                    <svg class="absolute top-4 right-4 w-24 h-24 text-white/10 group-hover:rotate-12 transition transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>