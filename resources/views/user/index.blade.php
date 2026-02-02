<x-user-layout>
    {{-- 
        =============================================
        STATE MANAGEMENT (Alpine.js)
        =============================================
        Mengatur Tabs (Video/Modul) dan Modal Player
    --}}
    <div x-data="{ 
            activeTab: 'video',
            modalOpen: false,
            videoSrc: '',
            videoType: '',
            videoTitle: '',
            videoDesc: '',
            videoDate: '',
            videoAuthor: '{{ config('app.name') }}',
            
            // Fungsi Buka Player (Youtube / Local)
            openPlayer(type, src, title, desc, date, author) {
                this.videoType = type;
                this.videoTitle = title;
                this.videoDesc = desc;
                this.videoDate = date;
                this.videoAuthor = author || 'Admin SiagaBencana';
                this.modalOpen = true;
                
                // Setup Source URL
                if(type === 'youtube') {
                    // Auto play & clean interface param
                    this.videoSrc = 'https://www.youtube.com/embed/' + src + '?autoplay=1&rel=0&modestbranding=1&playsinline=1';
                } else {
                    this.videoSrc = src;
                }

                // Lock Scroll
                document.body.style.overflow = 'hidden';
            },

            // Fungsi Tutup Player
            closeModal() {
                this.modalOpen = false;
                this.videoSrc = ''; // Stop video
                document.body.style.overflow = 'auto'; // Unlock Scroll
            }
         }"
         class="min-h-screen bg-gray-50 text-slate-900 font-sans"> 

        {{-- 
            =============================================
            1. HERO HEADER / CHANNEL BANNER
            =============================================
        --}}
        <div class="relative w-full h-64 md:h-80 overflow-hidden bg-slate-900 group">
            @php
                $bannerGradient = match($category->slug) {
                    'anak-anak' => 'from-blue-600 via-indigo-500 to-cyan-400',
                    'umkm' => 'from-orange-600 via-amber-500 to-yellow-400',
                    'kesehatan' => 'from-emerald-600 via-teal-500 to-green-400',
                    default => 'from-slate-800 via-slate-700 to-gray-600'
                };
            @endphp
            
            {{-- Dynamic Gradient Background --}}
            <div class="absolute inset-0 bg-gradient-to-br {{ $bannerGradient }} opacity-90 transition duration-700 group-hover:scale-105"></div>
            
            {{-- Pattern Overlay (Modern Dots) --}}
            <div class="absolute inset-0 opacity-20" 
                 style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;">
            </div>
            
            {{-- Banner Content --}}
            <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 flex items-end justify-between bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                <div class="flex items-center gap-5 md:gap-8">
                    {{-- Channel Avatar --}}
                    <div class="w-20 h-20 md:w-28 md:h-28 rounded-full bg-white p-1.5 shadow-2xl shadow-black/30 transform translate-y-4 md:translate-y-0">
                        <div class="w-full h-full rounded-full bg-slate-100 flex items-center justify-center text-3xl md:text-5xl font-black text-slate-800 uppercase">
                            {{ substr($category->name, 0, 1) }}
                        </div>
                    </div>
                    
                    {{-- Text Info --}}
                    <div class="text-white pb-2">
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-2 drop-shadow-md">{{ $category->name }}</h1>
                        <p class="text-white/90 text-sm md:text-lg font-medium max-w-2xl line-clamp-2 leading-relaxed">
                            {{ $category->description ?? 'Kumpulan materi edukasi dan panduan keselamatan bencana.' }}
                        </p>
                        
                        {{-- Stats (Optional) --}}
                        <div class="flex gap-4 mt-3 text-xs md:text-sm font-semibold text-white/70 uppercase tracking-wider">
                            <span>{{ $videos->total() }} Video</span>
                            <span>•</span>
                            <span>{{ $modules->total() }} Modul Bacaan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 
            =============================================
            2. STICKY NAVIGATION BAR (TABS & SEARCH)
            =============================================
        --}}
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

        {{-- 
            =============================================
            3. MAIN CONTENT AREA
            =============================================
        --}}
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-[600px]">
            
            {{-- 
                TAB 1: VIDEO GRID
            --}}
            <div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300 opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 gap-y-10">
                    @forelse($videos as $video)
                        {{-- Video Card --}}
                        <div class="group cursor-pointer flex flex-col gap-3"
                             @click="openPlayer(
                                '{{ $video->youtube_id ? 'youtube' : 'upload' }}', 
                                '{{ $video->youtube_id ? $video->youtube_id : asset('storage/' . $video->video_file) }}', 
                                '{{ addslashes($video->title) }}', 
                                '{{ addslashes($video->description) }}',
                                '{{ $video->created_at->diffForHumans() }}',
                                '{{ $video->topic->category->name }}'
                             )">
                            
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
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
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

            {{-- 
                TAB 2: MODULE GRID
            --}}
            <div x-show="activeTab === 'modul'" style="display: none;" x-transition:enter="transition ease-out duration-300 opacity-0 translate-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($modules as $module)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
                            {{-- Decorative Top Line --}}
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                            <div class="flex items-start justify-between mb-4">
                                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded uppercase tracking-wide">{{ $module->file_type ?? 'PDF' }}</span>
                            </div>

                            <div class="flex-grow">
                                <h3 class="text-lg font-bold text-slate-800 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">{{ $module->title }}</h3>
                                <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-4">{{ $module->summary }}</p>
                            </div>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                                <span class="text-xs font-medium text-slate-400">{{ $module->created_at->format('d M Y') }}</span>
                                
                                {{-- Tombol BACA (Route ke fitur flipbook) --}}
                                <a href="{{ route('user.module.read', $module->slug) }}" 
                                   class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                                    Baca Sekarang
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                         {{-- Empty State Modul --}}
                         <div class="col-span-full py-24 flex flex-col items-center justify-center text-center">
                            <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800">Belum ada modul bacaan</h3>
                            <p class="text-slate-500 max-w-md mt-2">Daftar buku panduan dan modul PDF belum tersedia untuk kategori ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Modul --}}
                <div class="mt-16">
                    {{ $modules->appends(['activeTab' => 'modul'])->links() }}
                </div>
            </div>
        </div>

        {{-- 
            =============================================
            4. THEATER MODE PLAYER (YOUTUBE STYLE MODAL)
            =============================================
        --}}
        <div x-show="modalOpen" style="display: none;" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] overflow-y-auto bg-black/95 backdrop-blur-md"
            role="dialog" aria-modal="true">
            
            {{-- Close Button --}}
            <button @click="closeModal()" class="fixed top-6 right-6 z-[110] group p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                <svg class="w-8 h-8 text-white/70 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="min-h-screen flex justify-center py-6 px-4 sm:px-6">
                <div class="w-full max-w-[1700px] flex flex-col lg:flex-row gap-8 mt-10">
                    
                    {{-- LEFT: Main Player --}}
                    <div class="flex-grow lg:w-[72%]">
                        {{-- Video Container --}}
                        <div class="w-full aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl relative ring-1 ring-white/10">
                             <template x-if="modalOpen && videoType === 'youtube'">
                                <iframe class="w-full h-full absolute inset-0" :src="videoSrc" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                            </template>
                            <template x-if="modalOpen && videoType === 'upload'">
                                <video class="w-full h-full absolute inset-0" controls autoplay>
                                    <source :src="videoSrc" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            </template>
                        </div>

                        {{-- Info Section --}}
                        <div class="mt-6 text-white">
                            <h1 class="text-2xl md:text-3xl font-bold line-clamp-2 leading-tight tracking-tight" x-text="videoTitle"></h1>
                            
                            <div class="flex flex-col md:flex-row md:items-center justify-between mt-4 pb-6 border-b border-white/10 gap-6">
                                {{-- Author Profile --}}
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-bold text-lg shadow-lg ring-2 ring-white/20">
                                        {{ substr($category->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-base" x-text="videoAuthor"></h3>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-400">SiagaBencana Official</span>
                                            <svg class="w-3 h-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </div>
                                    <button class="ml-2 px-5 py-2 bg-white text-black text-sm font-bold rounded-full hover:bg-gray-200 transition">
                                        Langganan
                                    </button>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-2">
                                    <button class="flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 rounded-full text-sm font-medium transition backdrop-blur-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                                        Suka
                                    </button>
                                    <button class="flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 rounded-full text-sm font-medium transition backdrop-blur-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                        Bagikan
                                    </button>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="mt-4 bg-white/5 p-5 rounded-2xl hover:bg-white/10 transition cursor-default border border-white/5">
                                <div class="flex gap-3 text-sm font-bold text-white mb-3">
                                    <span x-text="videoDate"></span>
                                    <span>•</span>
                                    <span class="text-blue-400">#EdukasiBencana</span>
                                </div>
                                <p class="text-sm text-gray-300 leading-7 whitespace-pre-line" x-text="videoDesc"></p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: Up Next / Recommendations --}}
                    <div class="hidden lg:block w-[28%]">
                        <div class="sticky top-6">
                            <h3 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
                                <span>Tonton Berikutnya</span>
                                <span class="px-2 py-0.5 bg-white/10 text-xs rounded text-gray-300">Autoplay</span>
                            </h3>
                            <div class="space-y-4">
                                @foreach($videos->take(6) as $related)
                                <div class="flex gap-3 group cursor-pointer p-2 rounded-xl hover:bg-white/5 transition"
                                     @click="openPlayer(
                                        '{{ $related->youtube_id ? 'youtube' : 'upload' }}', 
                                        '{{ $related->youtube_id ? $related->youtube_id : asset('storage/' . $related->video_file) }}', 
                                        '{{ addslashes($related->title) }}', 
                                        '{{ addslashes($related->description) }}',
                                        '{{ $related->created_at->diffForHumans() }}',
                                        '{{ $related->topic->category->name }}'
                                     )">
                                    <div class="relative w-40 aspect-video rounded-lg overflow-hidden bg-gray-800 flex-shrink-0 ring-1 ring-white/10">
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
                                    <div class="flex flex-col justify-center">
                                        <h4 class="text-sm font-bold text-white line-clamp-2 leading-snug group-hover:text-blue-400 transition">{{ $related->title }}</h4>
                                        <p class="text-xs text-gray-400 mt-1.5">{{ $category->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $related->created_at->diffForHumans(null, true) }} yg lalu</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>