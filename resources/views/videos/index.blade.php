<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-800">Galeri Video</h2>
                    <p class="text-slate-500 text-sm">Kelola materi pembelajaran berbasis video.</p>
                </div>

                {{-- TOMBOL UPLOAD VIDEO --}}
                <a href="{{ route('videos.create') }}" class="px-6 py-3 bg-red-600 text-white font-bold rounded-full shadow-lg hover:bg-red-700 hover:shadow-red-500/30 transition transform active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Upload Video
                </a>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- GRID VIDEO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($videos as $video)
                    <div class="bg-white rounded-[25px] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300 border border-slate-100 group">
                        
                        {{-- Thumbnail Area --}}
                        <div class="relative aspect-video bg-slate-900 overflow-hidden">
                            
                            {{-- LOGIKA BARU: Cek Manual -> Cek YouTube -> Cek Kosong --}}
                            @if($video->thumbnail)
                                {{-- 1. Prioritas Utama: Gambar Upload Manual --}}
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $video->title }}">
                            
                            @elseif($video->youtube_id)
                                {{-- 2. Prioritas Kedua: Otomatis Tarik dari YouTube --}}
                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="YouTube Thumb">
                                
                                {{-- Label YouTube Kecil --}}
                                <div class="absolute bottom-3 right-3 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-md flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                    YouTube
                                </div>

                            @else
                                {{-- 3. Terakhir: Kalau gak ada dua-duanya, baru munculin Placeholder Gradient --}}
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500 to-orange-600 group-hover:scale-110 transition duration-500 relative">
                                    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmYiLz48L3N2Zz4=')]"></div>
                                    <div class="text-center p-4">
                                        <svg class="w-12 h-12 text-white/80 mx-auto mb-2 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="text-white/90 text-[10px] font-bold uppercase tracking-widest border border-white/30 px-2 py-1 rounded">No Thumbnail</span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="px-2 py-1 bg-green-500/90 backdrop-blur text-white text-[10px] font-bold uppercase rounded-md shadow-sm">Aktif</span>
                            </div>
                        </div>

                        {{-- Content Area --}}
                        <div class="p-6 relative">
                            <div class="absolute -top-3 right-5 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2 line-clamp-1 group-hover:text-red-600 transition" title="{{ $video->title }}">
                                {{ $video->title }}
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-2 mb-4 h-10 leading-relaxed">
                                {{ $video->description }}
                            </p>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $video->created_at->format('d M Y') }}
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('videos.edit', $video) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-blue-600 rounded-full hover:bg-blue-50 transition" title="Edit Video">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Hapus video ini selamanya?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 text-slate-400 hover:text-red-600 rounded-full hover:bg-red-50 transition" title="Hapus Video">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-[30px] border-2 border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Belum ada video tersedia</h3>
                        <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Mulai dengan mengupload video pembelajaran baru.</p>
                        {{-- Tombol Empty State --}}
                        <a href="{{ route('videos.create') }}" class="mt-6 inline-block px-6 py-2 bg-red-100 text-red-700 font-bold rounded-full hover:bg-red-200 transition text-sm">
                            + Upload Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>