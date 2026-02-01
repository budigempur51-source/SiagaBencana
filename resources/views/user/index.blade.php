<x-user-layout>
    {{-- Main State: Tabs & Video Modal --}}
    <div x-data="{ 
            activeTab: 'video',
            modalOpen: false,
            videoSrc: '',
            videoType: '',
            videoTitle: '',
            videoDesc: '',
            videoDate: '',
            videoAuthor: '{{ config('app.name') }}',
            relatedVideos: [],
            
            // Fungsi Buka Player ala YouTube
            openPlayer(type, src, title, desc, date, author) {
                this.videoType = type;
                this.videoTitle = title;
                this.videoDesc = desc;
                this.videoDate = date;
                this.videoAuthor = author || 'Admin SiagaBencana';
                this.modalOpen = true;
                
                // Set Source
                if(type === 'youtube') {
                    this.videoSrc = 'https://www.youtube.com/embed/' + src + '?autoplay=1&rel=0&modestbranding=1';
                } else {
                    this.videoSrc = src;
                }

                // Stop Scroll Body
                document.body.style.overflow = 'hidden';
            },

            // Fungsi Tutup
            closeModal() {
                this.modalOpen = false;
                this.videoSrc = '';
                document.body.style.overflow = 'auto';
            }
         }"
         class="min-h-screen bg-[#0f0f0f] text-white"> 
         {{-- Background diganti Hitam YouTube (#0f0f0f) atau Putih tergantung selera. 
              Disini saya pakai PUTIH/ABU TERANG biar konsisten sama UserLayout yang putih, 
              tapi elemennya kita buat ala YouTube --}}
    
    <div class="min-h-screen bg-white text-slate-900">

        {{-- Hero / Channel Banner --}}
        <div class="relative w-full h-48 md:h-64 overflow-hidden bg-slate-900">
             @php
                $bannerGradient = match($category->slug) {
                    'anak-anak' => 'from-blue-600 via-blue-500 to-cyan-400',
                    'umkm' => 'from-orange-600 via-orange-500 to-amber-400',
                    'kesehatan' => 'from-emerald-600 via-emerald-500 to-teal-400',
                    default => 'from-slate-800 via-slate-700 to-gray-600'
                };
            @endphp
            <div class="absolute inset-0 bg-gradient-to-r {{ $bannerGradient }} opacity-90"></div>
            {{-- Pattern Overlay --}}
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
            <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 flex items-end justify-between bg-gradient-to-t from-black/60 to-transparent">
                <div class="flex items-center gap-4 md:gap-6">
                    {{-- Channel Avatar --}}
                    <div class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-white p-1 shadow-2xl">
                        <div class="w-full h-full rounded-full bg-slate-100 flex items-center justify-center text-2xl md:text-4xl font-black text-slate-800 uppercase">
                            {{ substr($category->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="text-white">
                        <h1 class="text-2xl md:text-4xl font-bold tracking-tight mb-1">{{ $category->name }}</h1>
                        <p class="text-white/80 text-sm md:text-base font-medium max-w-xl line-clamp-1">{{ $category->description }}</p>
                    </div>
                </div>
                
                {{-- Subscribe Button (Fake) --}}
                <div class="hidden md:block">
                    <button class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold text-sm hover:bg-slate-200 transition">
                        Berlangganan
                    </button>
                </div>
            </div>
        </div>

        {{-- Sticky Navigation Bar (Tabs & Search) --}}
        <div class="sticky top-16 z-30 bg-white/95 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    {{-- Tabs --}}
                    <div class="flex space-x-6 h-full">
                        <button @click="activeTab = 'video'" 
                                :class="activeTab === 'video' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="h-full px-1 text-sm font-bold border-b-2 transition-colors uppercase tracking-wide">
                            Video
                        </button>
                        <button @click="activeTab = 'modul'" 
                                :class="activeTab === 'modul' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="h-full px-1 text-sm font-bold border-b-2 transition-colors uppercase tracking-wide">
                            Modul
                        </button>
                    </div>

                    {{-- Search --}}
                    <form method="GET" action="{{ route('user.hub', $category->slug) }}" class="hidden md:block w-96">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search }}" 
                                   class="w-full pl-4 pr-10 py-2 rounded-full border border-slate-300 bg-slate-50 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                                   placeholder="Telusuri channel ini...">
                            <button type="submit" class="absolute right-0 top-0 h-full px-3 text-slate-400 hover:text-slate-600 bg-slate-100 rounded-r-full border-l border-slate-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-[600px]">
            
            {{-- TAB: VIDEO --}}
            <div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
                    @forelse($videos as $video)
                        {{-- YouTube Card Style --}}
                        <div class="group cursor-pointer flex flex-col gap-3"
                             @click="openPlayer(
                                '{{ $video->youtube_id ? 'youtube' : 'upload' }}', 
                                '{{ $video->youtube_id ? $video->youtube_id : asset('storage/' . $video->video_file) }}', 
                                '{{ addslashes($video->title) }}', 
                                '{{ addslashes($video->description) }}',
                                '{{ $video->created_at->diffForHumans() }}',
                                '{{ $video->topic->category->name }}'
                             )">
                            
                            {{-- Thumbnail Container --}}
                            <div class="relative aspect-video rounded-xl overflow-hidden bg-slate-200">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @elseif($video->youtube_id)
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                @endif
                                
                                {{-- Duration Badge --}}
                                @if($video->duration > 0)
                                    <span class="absolute bottom-2 right-2 bg-black/80 text-white text-xs font-bold px-1.5 py-0.5 rounded">
                                        {{ floor($video->duration / 60) }}:{{ str_pad($video->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                @endif
                                
                                {{-- Shorts Badge --}}
                                @if($video->is_short)
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-sm flex items-center gap-1 shadow-md">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                                            SHORTS
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Meta Info --}}
                            <div class="flex gap-3 items-start">
                                {{-- Avatar (Admin/Channel) --}}
                                <div class="flex-shrink-0">
                                    <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-xs">
                                        {{ substr($category->name, 0, 1) }}
                                    </div>
                                </div>
                                
                                {{-- Text Info --}}
                                <div class="flex flex-col">
                                    <h3 class="text-base font-bold text-slate-900 leading-snug line-clamp-2 mb-1 group-hover:text-blue-600 transition-colors">
                                        {{ $video->title }}
                                    </h3>
                                    <div class="text-sm text-slate-500 font-medium">
                                        <p>{{ $category->name }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            {{ $video->level }} • {{ $video->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <h3 class="text-lg font-bold text-slate-900">Belum ada video</h3>
                            <p class="text-slate-500">Materi sedang disiapkan oleh admin.</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $videos->appends(['activeTab' => 'video'])->links() }}
                </div>
            </div>

            {{-- TAB: MODUL --}}
            <div x-show="activeTab === 'modul'" style="display: none;" x-transition:enter="transition ease-out duration-300">
                <div class="space-y-4">
                    @forelse($modules as $module)
                        <div class="bg-white rounded-xl p-4 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition flex gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $module->title }}</h3>
                                <p class="text-sm text-slate-500 line-clamp-1">{{ $module->summary }}</p>
                            </div>
                            <div class="flex items-center">
                                <a href="#" class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-blue-600 transition">Baca</a>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center text-slate-400">Belum ada modul bacaan.</div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{ $modules->appends(['activeTab' => 'modul'])->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- YOUTUBE-STYLE THEATER MODAL --}}
    <div x-show="modalOpen" style="display: none;" 
         class="fixed inset-0 z-[100] overflow-y-auto bg-black/95 backdrop-blur-sm"
         role="dialog" aria-modal="true">
        
        {{-- Close Button (Top Right Fixed) --}}
        <button @click="closeModal()" class="fixed top-4 right-4 z-[110] text-gray-400 hover:text-white p-2 bg-black/50 rounded-full transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="min-h-screen flex justify-center py-4 px-4 sm:px-6">
            <div class="w-full max-w-[1700px] flex flex-col lg:flex-row gap-6 mt-4 md:mt-8">
                
                {{-- LEFT COLUMN: PLAYER & INFO --}}
                <div class="flex-grow lg:w-[70%] xl:w-[75%]">
                    {{-- Player Wrapper (16:9) --}}
                    <div class="w-full aspect-video bg-black rounded-xl overflow-hidden shadow-2xl relative ring-1 ring-white/10">
                         <template x-if="modalOpen && videoType === 'youtube'">
                            <iframe class="w-full h-full absolute inset-0" :src="videoSrc" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                        </template>
                        <template x-if="modalOpen && videoType === 'upload'">
                            <video class="w-full h-full absolute inset-0" controls autoplay>
                                <source :src="videoSrc" type="video/mp4">
                            </video>
                        </template>
                    </div>

                    {{-- Title & Info --}}
                    <div class="mt-4 text-white">
                        <h1 class="text-xl md:text-2xl font-bold line-clamp-2 leading-snug" x-text="videoTitle"></h1>
                        
                        {{-- Action Bar --}}
                        <div class="flex flex-col md:flex-row md:items-center justify-between mt-3 pb-3 border-b border-gray-800 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center font-bold text-sm shadow">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-sm" x-text="videoAuthor"></h3>
                                    <p class="text-xs text-gray-400">Admin Verified</p>
                                </div>
                                <button class="ml-4 px-4 py-2 bg-white text-black text-sm font-bold rounded-full hover:bg-gray-200 transition">
                                    Berlangganan
                                </button>
                            </div>

                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-2 px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded-full text-sm font-medium transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                                    Suka
                                </button>
                                <button class="flex items-center gap-2 px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded-full text-sm font-medium transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                    Bagikan
                                </button>
                            </div>
                        </div>

                        {{-- Description Box --}}
                        <div class="mt-4 bg-gray-900/50 p-4 rounded-xl hover:bg-gray-900 transition cursor-default">
                            <div class="flex gap-2 text-sm font-bold text-white mb-2">
                                <span x-text="videoDate"></span>
                                <span>•</span>
                                <span class="text-blue-400">#EdukasiBencana</span>
                            </div>
                            <p class="text-sm text-gray-300 leading-relaxed whitespace-pre-line" x-text="videoDesc"></p>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: UP NEXT (Recommendation) --}}
                <div class="hidden lg:block w-[30%] xl:w-[25%]">
                    <h3 class="text-lg font-bold text-white mb-4">Tonton Berikutnya</h3>
                    <div class="space-y-3">
                        {{-- Loop Static Recommendation dari List Video yg ada --}}
                        @foreach($videos->take(6) as $related)
                        <div class="flex gap-2 group cursor-pointer"
                             @click="openPlayer(
                                '{{ $related->youtube_id ? 'youtube' : 'upload' }}', 
                                '{{ $related->youtube_id ? $related->youtube_id : asset('storage/' . $related->video_file) }}', 
                                '{{ addslashes($related->title) }}', 
                                '{{ addslashes($related->description) }}',
                                '{{ $related->created_at->diffForHumans() }}',
                                '{{ $related->topic->category->name }}'
                             )">
                            <div class="relative w-40 aspect-video rounded-lg overflow-hidden bg-gray-800 flex-shrink-0">
                                @if($related->thumbnail)
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" class="w-full h-full object-cover">
                                @elseif($related->youtube_id)
                                    <img src="https://img.youtube.com/vi/{{ $related->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-700"></div>
                                @endif
                                <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] font-bold px-1 rounded">
                                    {{ floor($related->duration / 60) }}:{{ str_pad($related->duration % 60, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white line-clamp-2 leading-tight group-hover:text-blue-400 transition">{{ $related->title }}</h4>
                                <p class="text-xs text-gray-400 mt-1">{{ $category->name }}</p>
                                <p class="text-xs text-gray-500">{{ $related->created_at->diffForHumans(null, true) }} yg lalu</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>