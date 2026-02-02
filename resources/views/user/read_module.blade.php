<x-user-layout>
    {{-- 
        =========================================================
        FLIPBOOK READER (LIGHT MODE & FULL FEATURES)
        =========================================================
        Fixes:
        1. UI kembali ke Light Mode (Putih/Abu) agar konsisten.
        2. Masalah "Layar Hitam" diperbaiki dengan auto-trigger resize.
        3. Fitur Sidebar Info dikembalikan untuk konteks materi.
        4. Menggunakan PDF.js v2.9 (Stabil) + Cache Buster.
    --}}

    @push('scripts')
        {{-- Load Library Stabil --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js?v={{ time() }}"></script>
        <script src="https://unpkg.com/page-flip@2.0.7/dist/js/page-flip.browser.js?v={{ time() }}"></script>
        
        <script>
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js?v={{ time() }}';
        </script>
    @endpush

    <div class="bg-gray-100 min-h-screen flex flex-col font-sans" x-data="flipbookApp()">
        
        {{-- 1. TOP NAVIGATION BAR (Light Theme) --}}
        <div class="bg-white border-b border-gray-200 sticky top-16 z-30 shadow-sm h-16">
            <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
                
                {{-- Kiri: Breadcrumb & Judul --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('user.hub', $module->topic->category->slug) }}?activeTab=modul" 
                       class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition group">
                        <div class="p-2 rounded-full group-hover:bg-blue-50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </div>
                        <span class="hidden sm:inline font-medium text-sm">Kembali</span>
                    </a>
                    <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>
                    <div>
                        <h1 class="text-gray-900 font-bold text-lg leading-tight truncate max-w-[200px] sm:max-w-md" title="{{ $module->title }}">
                            {{ $module->title }}
                        </h1>
                    </div>
                </div>

                {{-- Kanan: Status Halaman --}}
                <div class="hidden md:flex items-center bg-gray-100 rounded-full px-4 py-1.5 border border-gray-200">
                    <span class="text-sm font-mono font-bold text-gray-600">
                        Hal <span x-text="currentPage">1</span> / <span x-text="totalPages">...</span>
                    </span>
                </div>
            </div>
        </div>

        {{-- 2. MAIN CONTENT (Split View) --}}
        <div class="flex-grow flex flex-col lg:flex-row h-[calc(100vh-8rem)] overflow-hidden">
            
            {{-- AREA BUKU (KIRI/TENGAH) --}}
            <div class="flex-grow bg-gray-100 relative flex items-center justify-center p-4 lg:p-8 overflow-hidden">
                
                {{-- Loading State --}}
                <div x-show="isLoading && !isError" class="absolute inset-0 z-20 flex flex-col items-center justify-center bg-gray-100">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-200 border-t-blue-600 mb-4"></div>
                    <h3 class="text-gray-800 font-bold text-lg">Membuka Buku...</h3>
                    <p class="text-gray-500 text-sm mt-1" x-text="loadingStatus"></p>
                </div>

                {{-- Error State --}}
                <div x-show="isError" style="display: none;" class="absolute inset-0 z-20 flex flex-col items-center justify-center bg-gray-100">
                    <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-md mx-4">
                        <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Gagal Memuat</h3>
                        <p class="text-gray-500 text-sm mb-6" x-text="errorMessage"></p>
                        <a href="{{ $fileUrl }}" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition">
                            Buka PDF Manual
                        </a>
                    </div>
                </div>

                {{-- FLIPBOOK CONTAINER --}}
                {{-- Kita gunakan opacity 0 di awal untuk mencegah glitch hitam --}}
                <div class="relative transition-all duration-700 ease-out"
                     x-show="!isLoading && !isError"
                     x-transition:enter="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    
                    {{-- Shadow buku agar terlihat 3D di atas background abu --}}
                    <div class="relative" style="box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                        <div id="book" class="hidden"></div>
                    </div>

                </div>

                {{-- Navigasi Floating (Mobile Only) --}}
                <div class="lg:hidden absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-4 bg-white px-6 py-2 rounded-full shadow-lg border border-gray-100 z-30">
                    <button @click="prevPage()" class="text-gray-600 hover:text-blue-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                    <span class="font-bold text-gray-800"><span x-text="currentPage"></span></span>
                    <button @click="nextPage()" class="text-gray-600 hover:text-blue-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- SIDEBAR INFO (KANAN - DESKTOP) --}}
            <div class="hidden lg:flex flex-col w-96 bg-white border-l border-gray-200 h-full overflow-y-auto z-10">
                <div class="p-6">
                    {{-- Kategori --}}
                    <div class="mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 uppercase tracking-wide">
                            {{ $module->topic->category->name }}
                        </span>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 leading-snug mb-2">{{ $module->title }}</h2>
                    <p class="text-sm text-gray-500 mb-6">{{ $module->created_at->translatedFormat('d F Y') }}</p>

                    {{-- Deskripsi --}}
                    <div class="prose prose-sm text-gray-600 mb-8">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tentang Modul</h4>
                        <p>{{ $module->description ?? 'Tidak ada deskripsi tambahan untuk modul ini.' }}</p>
                    </div>

                    {{-- Tombol Navigasi Desktop --}}
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button @click="prevPage()" class="flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Sebelumnya
                        </button>
                        <button @click="nextPage()" class="flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm transition">
                            Selanjutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    {{-- Download --}}
                    <a href="{{ $fileUrl }}" download class="flex items-center justify-center gap-2 w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md shadow-blue-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh File PDF
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script>
        function flipbookApp() {
            return {
                pdfDoc: null,
                book: null,
                isLoading: true,
                isError: false,
                errorMessage: '',
                loadingStatus: 'Menghubungkan...',
                currentPage: 1,
                totalPages: 0,
                pdfUrl: '{{ $fileUrl }}',

                async init() {
                    try {
                        const loadingTask = pdfjsLib.getDocument(this.pdfUrl);
                        
                        loadingTask.promise.then(async (pdf) => {
                            this.pdfDoc = pdf;
                            this.totalPages = this.pdfDoc.numPages;
                            this.loadingStatus = `Merender ${this.totalPages} halaman...`;

                            const bookElement = document.getElementById('book');
                            
                            // Limit 50 Halaman (Safety)
                            const limitPages = Math.min(this.totalPages, 50); 
                            
                            for (let pageNum = 1; pageNum <= limitPages; pageNum++) {
                                const page = await this.pdfDoc.getPage(pageNum);
                                // Scale 1.5 (High Quality)
                                const viewport = page.getViewport({ scale: 1.5 });
                                
                                const canvas = document.createElement('canvas');
                                const context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;
                                
                                // FIX: Set dimensi CSS eksplisit agar tidak hitam saat load
                                canvas.style.width = '100%';
                                canvas.style.height = '100%';
                                canvas.style.display = 'block'; 
                                
                                const renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                
                                await page.render(renderContext).promise;

                                const pageDiv = document.createElement('div');
                                pageDiv.classList.add('bg-white'); // Warna kertas putih
                                
                                if (pageNum === 1) pageDiv.setAttribute('data-density', 'hard');
                                else pageDiv.setAttribute('data-density', 'soft');
                                
                                pageDiv.appendChild(canvas);
                                bookElement.appendChild(pageDiv);
                                
                                this.loadingStatus = `Menyiapkan hal ${pageNum}...`;
                            }

                            // Beri jeda sedikit agar DOM canvas benar-benar siap
                            setTimeout(() => {
                                this.initFlipbook();
                                this.isLoading = false;
                            }, 500);

                        }, (error) => {
                             throw error;
                        });

                    } catch (error) {
                        console.error('Flipbook Error:', error);
                        this.isError = true;
                        this.errorMessage = 'Terjadi kesalahan saat memuat PDF.';
                    }
                },

                initFlipbook() {
                    const bookElement = document.getElementById('book');
                    bookElement.classList.remove('hidden');

                    const isMobile = window.innerWidth < 1024;
                    
                    // Dimensi Buku
                    // Desktop: Lebar agak besar agar enak dibaca di split screen
                    // Mobile: Full width
                    const width = isMobile ? window.innerWidth * 0.9 : 450;
                    const height = isMobile ? window.innerHeight * 0.6 : 600;

                    this.book = new St.PageFlip(bookElement, {
                        width: width,
                        height: height,
                        size: isMobile ? 'fixed' : 'stretch', // Stretch di desktop biar responsif
                        minWidth: 300,
                        maxWidth: 1000,
                        minHeight: 400,
                        maxHeight: 1200,
                        maxShadowOpacity: 0.2, // Shadow lebih halus (Light Mode)
                        showCover: true,
                        mobileScrollSupport: false 
                    });

                    this.book.loadFromHTML(document.querySelectorAll('#book > div'));

                    this.book.on('flip', (e) => {
                        this.currentPage = e.data + 1;
                    });

                    // FIX UTAMA: Paksa trigger resize window setelah buku siap
                    // Ini yang mengatasi masalah "Hitam baru muncul pas di-inspect"
                    setTimeout(() => {
                        window.dispatchEvent(new Event('resize'));
                    }, 1000);
                },

                nextPage() { if(this.book) this.book.flipNext(); },
                prevPage() { if(this.book) this.book.flipPrev(); }
            }
        }
    </script>
</x-user-layout>