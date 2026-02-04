<x-user-layout>
    {{-- 
        =============================================
        STATE MANAGEMENT (Alpine.js) - REVISED
        =============================================
        Fokus: Perbaikan Parameter YouTube Embed
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
            
            init() {
                // Watcher untuk membersihkan state saat modal ditutup
                this.$watch('modalOpen', value => {
                    if (!value) {
                        this.videoSrc = ''; 
                        document.body.style.overflow = 'auto'; 
                    }
                });
            },

            openPlayer(data) {
                this.videoType = data.type;
                this.videoTitle = data.title;
                this.videoDesc = data.desc;
                this.videoDate = data.date;
                this.videoAuthor = data.author || 'SiagaBencana';
                
                // SETUP URL YOUTUBE YANG BENAR (FIXED)
                // Kita tambahkan parameter standar agar kontrol player berfungsi
                if(data.type === 'youtube') {
                    const baseUrl = 'https://www.youtube.com/embed/' + data.src;
                    const params = new URLSearchParams({
                        'autoplay': '1',       // Autoplay jalan
                        'controls': '1',       // PAKSA kontrol player muncul
                        'rel': '0',            // Jangan tampilkan video terkait dari channel lain
                        'showinfo': '0',       // Sembunyikan info title di atas (deprecated tapi good practice)
                        'modestbranding': '1', // Minimalisir logo YT
                        'playsinline': '1',    // Agar jalan di iOS webview
                        'iv_load_policy': '3'  // Sembunyikan anotasi video
                    });
                    this.videoSrc = baseUrl + '?' + params.toString();
                } else {
                    // Untuk Local Video
                    this.videoSrc = data.src;
                }

                this.modalOpen = true;
                document.body.style.overflow = 'hidden'; // Lock Scroll
            },

            closeModal() {
                this.modalOpen = false;
                // State lain akan di-reset oleh watcher di init()
            }
         }"
         class="min-h-screen bg-gray-50 text-slate-900 font-sans"> 

        {{-- 1. HERO HEADER --}}
        @include('user.partials.hero')

        {{-- 2. NAVIGATION BAR --}}
        @include('user.partials.navbar')

        {{-- 3. MAIN CONTENT AREA --}}
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-[600px]">
            
            {{-- Tab 1: Video Grid --}}
            @include('user.partials.videos')

            {{-- Tab 2: Module Grid --}}
            @include('user.partials.modules')
            
        </div>

        {{-- 4. THEATER MODE PLAYER (MODAL) --}}
        @include('user.partials.modal')

    </div>
</x-user-layout>