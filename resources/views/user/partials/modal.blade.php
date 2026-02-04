<div x-show="modalOpen" style="display: none;" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] overflow-y-auto bg-black/95 backdrop-blur-xl"
    role="dialog" aria-modal="true">
    
    {{-- Close Button (Floating Modern) --}}
    <button @click="closeModal()" class="fixed top-6 right-6 z-[110] group p-2.5 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md transition-all duration-300 hover:rotate-90">
        <svg class="w-6 h-6 text-white/80 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <div class="min-h-screen flex justify-center py-4 px-4 sm:px-6 lg:py-8">
        <div class="w-full max-w-[1600px] flex flex-col lg:flex-row gap-10 mt-8 lg:mt-4">
            
            {{-- ================= LEFT: Main Player Area ================= --}}
            <div class="flex-grow lg:w-[70%] xl:w-[72%]">
                {{-- Video Container (Cinema Style) --}}
                <div class="w-full aspect-video bg-[#0a0a0a] rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative ring-1 ring-white/5">
                     <template x-if="modalOpen && videoType === 'youtube'">
                        {{-- 
                            FIX ERROR 153 & TRACKING PREVENTION:
                            1. referrerpolicy="strict-origin-when-cross-origin" (WAJIB ADA)
                            2. allow="...; web-share" (Fitur modern)
                        --}}
                        <iframe class="w-full h-full absolute inset-0" 
                                :src="videoSrc" 
                                title="YouTube video player"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                        </iframe>
                    </template>
                    <template x-if="modalOpen && videoType === 'upload'">
                        <video class="w-full h-full absolute inset-0 outline-none" controls autoplay controlsList="nodownload">
                            <source :src="videoSrc" type="video/mp4">
                            Browser Anda tidak mendukung tag video modern.
                        </video>
                    </template>
                </div>

                {{-- Video Info Section (Clean & Modern) --}}
                <div class="mt-8 text-white px-2">
                    {{-- Title --}}
                    <h1 class="text-2xl md:text-4xl font-extrabold leading-tight tracking-tight text-white/95" x-text="videoTitle"></h1>
                    
                    {{-- Metadata Bar --}}
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mt-4 text-sm font-medium text-white/60">
                        <div class="flex items-center gap-2">
                             <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-[10px] font-bold text-white">
                                {{ substr($category->name ?? 'A', 0, 1) }}
                            </div>
                            <span x-text="videoAuthor" class="text-white/80"></span>
                        </div>
                        <span class="w-1 h-1 rounded-full bg-white/30"></span>
                        <span x-text="videoDate"></span>
                        <span class="w-1 h-1 rounded-full bg-white/30"></span>
                        {{-- Handle jika category undefined di JS --}}
                        <span class="text-blue-400 font-bold tracking-wide uppercase text-xs" x-text="videoAuthor"></span> 
                    </div>

                    {{-- Divider --}}
                    <div class="h-px w-full bg-gradient-to-r from-white/10 via-white/5 to-transparent my-6"></div>

                    {{-- Description (Clean Text) --}}
                    <div class="prose prose-invert prose-sm md:prose-base max-w-none text-white/70 leading-relaxed whitespace-pre-line" x-text="videoDesc">
                    </div>
                </div>
            </div>

            {{-- ================= RIGHT: Up Next / Recommendations ================= --}}
            <div class="hidden lg:block w-[30%] xl:w-[28%]">
                <div class="sticky top-8 pl-4">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center justify-between">
                        <span>Playlist Materi</span>
                        <span class="text-xs font-bold text-white/40 bg-white/10 px-3 py-1 rounded-full tracking-wider uppercase">Up Next</span>
                    </h3>
                    
                    <div class="space-y-5 pr-2 overflow-y-auto max-h-[calc(100vh-150px)] scrollbar-hide">
                        @foreach($videos->take(8) as $related)
                        {{-- Related Video Card (Minimalist) --}}
                        <div class="group flex gap-4 cursor-pointer p-3 rounded-2xl hover:bg-white/5 transition-all duration-300"
                             @click="openPlayer({
                                type: '{{ $related->youtube_id ? 'youtube' : 'upload' }}', 
                                src: '{{ $related->youtube_id ? $related->youtube_id : route('video.stream', $related->id) }}', 
                                title: {{ Js::from($related->title) }}, 
                                desc: {{ Js::from($related->description) }},
                                date: '{{ $related->created_at->diffForHumans() }}',
                                author: {{ Js::from($related->topic->category->name) }}
                             })">
                            
                            {{-- Thumbnail --}}
                            <div class="relative w-44 aspect-video rounded-xl overflow-hidden bg-gray-900 flex-shrink-0 ring-1 ring-white/10 group-hover:ring-white/20 transition">
                                @if($related->thumbnail)
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                                @elseif($related->youtube_id)
                                    <img src="https://img.youtube.com/vi/{{ $related->youtube_id }}/mqdefault.jpg" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-white/5 text-white/20">
                                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                @endif

                                {{-- Duration Label --}}
                                @if($related->duration > 0)
                                <span class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded text-center">
                                    {{ floor($related->duration / 60) }}:{{ str_pad($related->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex flex-col pt-1">
                                <h4 class="text-base font-bold text-white/90 line-clamp-2 leading-snug group-hover:text-blue-400 transition-colors duration-300">{{ $related->title }}</h4>
                                <div class="mt-2 flex items-center gap-2 text-xs font-medium text-white/50">
                                    <span>{{ $related->topic->category->name }}</span>
                                    <span class="w-0.5 h-0.5 rounded-full bg-white/30"></span>
                                    <span>{{ $related->created_at->diffForHumans(null, true) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>