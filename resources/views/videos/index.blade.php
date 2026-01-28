<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Database Video Edukasi') }}
            </h2>
            <a href="{{ route('videos.create') }}" class="px-6 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Video Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-2xl font-bold flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($videos as $video)
                    <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 group">
                        <div class="relative aspect-video">
                            <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover">
                            <div class="absolute bottom-2 right-2 bg-black/80 text-white text-[10px] px-2 py-1 rounded font-bold">
                                {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <a href="https://youtube.com/watch?v={{ $video->youtube_id }}" target="_blank" class="p-3 bg-white/20 backdrop-blur-md rounded-full text-white">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168l4.2 2.4a1 1 0 010 1.732l-4.2 2.4A1 1 0 018 12.832V7.168a1 1 0 011.555-.832z"/></svg>
                                </a>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-2 py-1 rounded-md text-[10px] font-black uppercase tracking-wider" style="background-color: {{ $video->topic->category->color }}20; color: {{ $video->topic->category->color }}">
                                    {{ $video->topic->category->name }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase">• {{ $video->level }}</span>
                            </div>
                            
                            <h3 class="font-bold text-gray-900 leading-snug mb-2 line-clamp-2 group-hover:text-red-600 transition">
                                {{ $video->title }}
                            </h3>
                            
                            <p class="text-xs text-gray-500 line-clamp-2 mb-4">
                                {{ $video->summary }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div class="flex items-center gap-2 text-[10px] font-bold text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8" stroke-width="2" stroke-linecap="round"/></svg>
                                    {{ $video->topic->title }}
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('videos.edit', $video) }}" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                                    </a>
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Hapus video ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                        <p class="text-gray-400 font-bold italic">Belum ada video yang diupload.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>