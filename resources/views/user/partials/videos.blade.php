<div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300 opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 gap-y-10">
        @forelse($videos as $video)
            {{-- Video Card --}}
            <div class="group cursor-pointer flex flex-col gap-3"
                 @click="openPlayer({
                    type: '{{ $video->youtube_id ? 'youtube' : 'upload' }}', 
                    {{-- FIX: Ganti asset() dengan route('video.stream') untuk video lokal --}}
                    src: '{{ $video->youtube_id ? $video->youtube_id : route('video.stream', $video->id) }}', 
                    title: {{ Js::from($video->title) }}, 
                    desc: {{ Js::from($video->description) }},
                    date: '{{ $video->created_at->diffForHumans() }}',
                    author: {{ Js::from($video->topic->category->name) }}
                 })">
                
                {{-- Thumbnail Wrapper --}}
                <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-200 shadow-sm group-hover:shadow-xl group-hover:shadow-blue-900/10 transition-all duration-300 ring-1 ring-black/5">
                    @if($video->thumbnail)
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @elseif($video->youtube_id)
                        <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    
                    {{-- Play Icon Overlay (On Hover) --}}
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                        <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center pl-1 shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
                            <svg class="w-6 h-6 text-slate-900" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>

                    {{-- Duration Badge --}}
                    @if($video->duration > 0)
                        <span class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-[11px] font-bold px-1.5 py-0.5 rounded-md shadow-sm">
                            {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    @endif
                    
                    {{-- Shorts Badge --}}
                    @if($video->is_short)
                        <div class="absolute top-2 right-2">
                            <span class="bg-red-600/90 backdrop-blur-md text-white text-[10px] font-extrabold px-2 py-1 rounded-md flex items-center gap-1 shadow-lg">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                                SHORTS
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Video Meta --}}
                <div class="flex gap-3 items-start px-1">
                    {{-- Topic Icon --}}
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 border border-white shadow-sm flex items-center justify-center text-slate-600 font-bold text-sm">
                            {{ substr($video->topic->title ?? 'U', 0, 1) }}
                        </div>
                    </div>
                    
                    <div class="flex flex-col">
                        <h3 class="text-[17px] font-bold text-slate-800 leading-snug line-clamp-2 mb-1 group-hover:text-blue-600 transition-colors">
                            {{ $video->title }}
                        </h3>
                        <div class="text-xs font-medium text-slate-500 flex flex-wrap gap-x-2 gap-y-1 items-center">
                            <span class="text-slate-600">{{ $video->topic->title }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span class="capitalize {{ $video->level === 'pemula' ? 'text-green-600' : ($video->level === 'menengah' ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $video->level }}
                            </span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $video->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State Video --}}
            <div class="col-span-full py-24 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800">Belum ada video materi</h3>
                <p class="text-slate-500 max-w-md mt-2">Materi untuk kategori ini sedang disiapkan oleh tim kami. Silakan cek kembali nanti.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination Video --}}
    <div class="mt-16">
        {{ $videos->appends(['activeTab' => 'video'])->links() }}
    </div>
</div>