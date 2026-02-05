<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-800">Modul & E-Book</h2>
                    <p class="text-slate-500 text-sm">Upload materi bacaan (PDF) untuk user.</p>
                </div>
                
                {{-- TOMBOL UPLOAD MODUL (FIX: BIRU SOLID + TEKS PUTIH) --}}
                <a href="{{ route('modules.create') }}" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-full shadow-lg hover:bg-blue-700 hover:shadow-blue-500/30 transition transform active:scale-95 flex items-center gap-2 border border-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Upload Modul
                </a>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded shadow-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- GRID MODUL --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($modules as $module)
                    <div class="bg-white rounded-[20px] shadow-sm hover:shadow-2xl transition duration-300 border border-slate-100 flex flex-col group overflow-hidden hover:-translate-y-1">
                        
                        {{-- Cover Image --}}
                        <div class="h-52 relative overflow-hidden">
                            @if($module->cover_image)
                                <img src="{{ asset('storage/' . $module->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 group-hover:scale-110 transition duration-500 relative">
                                    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmYiLz48L3N2Zz4=')]"></div>
                                    <div class="text-center p-4">
                                        <svg class="w-16 h-16 text-white/80 mx-auto mb-2 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        <span class="text-white/90 text-xs font-bold uppercase tracking-widest border border-white/30 px-2 py-1 rounded">No Cover</span>
                                    </div>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-black px-2 py-1 rounded shadow-lg">PDF</div>
                        </div>

                        {{-- Details --}}
                        <div class="p-5 flex flex-col flex-grow relative bg-white">
                            <div class="absolute -top-3 left-5 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            </div>
                            <div class="flex items-center gap-2 mb-3 mt-1">
                                <span class="text-[10px] uppercase font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">
                                    {{ $module->topic->name ?? 'Umum' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-slate-800 leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition text-sm">
                                {{ $module->title }}
                            </h3>
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-50">
                                <a href="{{ route('modules.edit', $module) }}" class="text-xs font-bold text-slate-400 hover:text-blue-600 flex items-center gap-1 transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Hapus modul ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 flex items-center gap-1 transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-[30px] border-2 border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Belum ada modul tersedia</h3>
                        <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Mulai dengan mengupload buku saku atau materi PDF.</p>
                        {{-- TOMBOL EMPTY STATE (FIX: BIRU SOLID + TEKS PUTIH) --}}
                        <a href="{{ route('modules.create') }}" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition text-sm shadow-md">
                            + Upload Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>