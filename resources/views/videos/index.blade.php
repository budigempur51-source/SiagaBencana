<x-app-layout>
    {{-- Main Container dengan Alpine.js untuk mengatur State Modal Video --}}
    <div x-data="{ 
        modalOpen: false,
        videoSrc: '',
        videoType: '',
        videoTitle: '',
        openVideo(type, src, title) {
            this.videoType = type;
            this.videoTitle = title;
            this.modalOpen = true;
            if(type === 'youtube') {
                this.videoSrc = 'https://www.youtube.com/embed/' + src + '?autoplay=1&rel=0';
            } else {
                this.videoSrc = src;
            }
        },
        closeModal() {
            this.modalOpen = false;
            this.videoSrc = ''; // Stop video saat tutup
        }
    }">

        <x-slot name="header">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                        {{ __('Pustaka Video') }}
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Edukasi bencana visual & interaktif untuk semua kalangan.</p>
                </div>
                <a href="{{ route('videos.create') }}" class="group relative inline-flex items-center justify-center px-6 py-3 text-base font-bold text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 shadow-lg shadow-blue-200">
                    <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Upload Video
                </a>
            </div>
        </x-slot>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm flex items-center justify-between" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-800">&times;</button>
                    </div>
                @endif

                {{-- Grid Video --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($videos as $video)
                        <div class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative">
                            
                            {{-- THUMBNAIL WRAPPER --}}
                            <div class="relative w-full aspect-video bg-gray-900 overflow-hidden cursor-pointer"
                                 @click="openVideo('{{ $video->youtube_id ? 'youtube' : 'upload' }}', '{{ $video->youtube_id ? $video->youtube_id : asset('storage/' . $video->video_file) }}', '{{ addslashes($video->title) }}')">
                                
                                {{-- Image --}}
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition duration-700 ease-out">
                                @elseif($video->youtube_id)
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition duration-700 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                        <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif

                                {{-- Overlay Gradient --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>

                                {{-- Play Button (Centered) --}}
                                <div class="absolute inset-0 flex items-center justify-center z-10">
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-red-600 group-hover:scale-110 transition duration-300 shadow-2xl border border-white/30">
                                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>

                                {{-- Top Badges --}}
                                <div class="absolute top-3 left-3 flex flex-wrap gap-2 z-20">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-xs font-bold rounded-lg shadow-sm uppercase tracking-wide" style="color: {{ $video->topic->category->color ?? '#374151' }}">
                                        {{ $video->topic->category->name }}
                                    </span>
                                    @if($video->is_short)
                                        <span class="px-3 py-1 bg-purple-600 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1 animate-pulse">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2.03c-.22-.09-.47-.03-.63.14L3.6 12.38c-.28.3-.06.79.35.79h5.68v7.8c0 .36.38.6.69.43l8.77-10.21c.28-.3-.06-.79-.35-.79h-5.68v-7.8c0-.23-.1-.45-.29-.57z"/></svg>
                                            SHORTS
                                        </span>
                                    @endif
                                </div>

                                {{-- Duration Badge --}}
                                @if($video->duration > 0)
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm z-20">
                                        {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                @endif
                            </div>

                            {{-- CONTENT AREA --}}
                            <div class="p-6 flex flex-col flex-grow bg-white">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded border 
                                        {{ $video->level == 'pemula' ? 'border-green-200 text-green-600 bg-green-50' : 
                                          ($video->level == 'menengah' ? 'border-yellow-200 text-yellow-600 bg-yellow-50' : 'border-red-200 text-red-600 bg-red-50') }}">
                                        {{ strtoupper($video->level) }}
                                    </span>
                                    <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $video->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $video->title }}
                                </h3>

                                <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 mb-4 flex-grow">
                                    {{ $video->summary }}
                                </p>

                                {{-- Footer Actions --}}
                                <div class="pt-4 mt-auto border-t border-gray-50 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 truncate max-w-[60%]">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                        <span class="truncate">{{ $video->topic->title }}</span>
                                    </div>
                                    
                                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('videos.edit', $video) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit Video">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                                        </a>
                                        <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                            @csrf @method('DELETE')
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus Video">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Empty State --}}
                        <div class="col-span-full py-20">
                            <div class="max-w-md mx-auto text-center bg-white p-10 rounded-3xl border border-dashed border-gray-300">
                                <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6 text-blue-500">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-900 mb-2">Belum ada video</h3>
                                <p class="text-gray-500 mb-8">Mulai bangun pustaka edukasi dengan mengupload video pertama.</p>
                                <a href="{{ route('videos.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                                    Upload Sekarang
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>

        {{-- VIDEO PLAYER MODAL --}}
        <div x-show="modalOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            
            {{-- Backdrop --}}
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" @click="closeModal()"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Modal Panel --}}
                <div class="inline-block align-bottom bg-black rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full relative border border-gray-800">
                    
                    {{-- Header Modal --}}
                    <div class="bg-gray-900 px-4 py-3 sm:px-6 flex justify-between items-center border-b border-gray-800">
                        <h3 class="text-lg leading-6 font-bold text-white truncate pr-4" id="modal-title" x-text="videoTitle"></h3>
                        <button type="button" @click="closeModal()" class="text-gray-400 hover:text-white transition focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Player Area --}}
                    <div class="aspect-video bg-black relative flex items-center justify-center">
                        {{-- Loading Indicator --}}
                        <div class="absolute inset-0 flex items-center justify-center text-gray-500 z-0">
                            <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                        {{-- YOUTUBE PLAYER --}}
                        <template x-if="modalOpen && videoType === 'youtube'">
                            <iframe class="w-full h-full absolute inset-0 z-10" 
                                    :src="videoSrc" 
                                    title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </template>

                        {{-- HTML5 LOCAL PLAYER --}}
                        <template x-if="modalOpen && videoType === 'upload'">
                            <video class="w-full h-full absolute inset-0 z-10" controls autoplay>
                                <source :src="videoSrc" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>