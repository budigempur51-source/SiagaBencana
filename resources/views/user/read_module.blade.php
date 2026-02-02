<x-user-layout>
    {{-- 
        =========================================================
        READER MODE INTERFACE
        =========================================================
        Layout khusus untuk membaca modul agar fokus (Distraction Free).
        Kita memisahkan area baca (PDF) dengan area informasi.
    --}}

    <div class="bg-gray-100 min-h-screen pb-12" x-data="{ sidebarOpen: true }">
        
        {{-- 1. TOP BAR NAVIGASI (Breadcrumbs & Actions) --}}
        <div class="bg-white border-b border-gray-200 sticky top-16 z-20 shadow-sm">
            <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                
                {{-- Left: Back & Title --}}
                <div class="flex items-center gap-4 overflow-hidden">
                    <a href="{{ route('user.hub', $module->topic->category->slug) }}?activeTab=modul" 
                       class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition font-medium text-sm flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                    <div class="h-6 w-px bg-gray-300 mx-2 hidden sm:block"></div>
                    <h1 class="text-lg font-bold text-gray-800 truncate" title="{{ $module->title }}">
                        {{ $module->title }}
                    </h1>
                </div>

                {{-- Right: Actions --}}
                <div class="flex items-center gap-3">
                    {{-- Toggle Info Sidebar --}}
                    <button @click="sidebarOpen = !sidebarOpen" 
                            class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition hidden lg:block"
                            title="Toggle Info Panel">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </button>

                    {{-- Download Button --}}
                    <a href="{{ $fileUrl }}" download 
                       class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span class="hidden sm:inline">Unduh PDF</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. MAIN WORKSPACE (Split Screen) --}}
        <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8 py-6 h-[calc(100vh-8rem)]">
            <div class="flex gap-6 h-full relative">
                
                {{-- A. PDF VIEWER (Flexible Width) --}}
                <div class="flex-grow h-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-300 relative transition-all duration-300">
                    
                    {{-- Embed PDF --}}
                    <iframe src="{{ $fileUrl }}#toolbar=0" 
                            class="w-full h-full" 
                            frameborder="0"
                            allowfullscreen>
                    </iframe>

                    {{-- Fallback jika browser tidak support --}}
                    <div class="absolute inset-0 z-[-1] flex flex-col items-center justify-center text-gray-500 bg-gray-50">
                        <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-lg font-semibold">Memuat Dokumen...</p>
                        <p class="text-sm">Jika dokumen tidak muncul, silakan <a href="{{ $fileUrl }}" class="text-blue-600 hover:underline">Download Disini</a>.</p>
                    </div>
                </div>

                {{-- B. SIDEBAR INFO (Right Side - Collapsible) --}}
                <div class="hidden lg:flex flex-col w-80 flex-shrink-0 transition-all duration-300"
                     x-show="sidebarOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="translate-x-full opacity-0 w-0"
                     x-transition:enter-end="translate-x-0 opacity-100 w-80"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="translate-x-0 opacity-100 w-80"
                     x-transition:leave-end="translate-x-full opacity-0 w-0">
                    
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 h-full overflow-y-auto p-6">
                        
                        {{-- Kategori Badge --}}
                        <div class="mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 uppercase tracking-wide">
                                {{ $module->topic->category->name }}
                            </span>
                        </div>

                        {{-- Judul & Metadata --}}
                        <h2 class="text-xl font-bold text-gray-900 leading-snug mb-2">{{ $module->title }}</h2>
                        <div class="flex items-center text-xs text-gray-500 mb-6 gap-2">
                            <span>{{ $module->created_at->format('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ $module->file_type ?? 'PDF' }}</span>
                        </div>

                        <hr class="border-gray-100 mb-6">

                        {{-- Deskripsi --}}
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Tentang Modul Ini</h3>
                        <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                            <p>{{ $module->description ?? 'Tidak ada deskripsi tambahan.' }}</p>
                        </div>

                        {{-- Call to Action / Topik Terkait --}}
                        <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Topik Pembelajaran</h4>
                            <p class="text-sm font-medium text-gray-800">{{ $module->topic->title }}</p>
                        </div>

                    </div>
                </div>

            </div>
            
            {{-- Mobile Info (Visible only on small screens) --}}
            <div class="lg:hidden mt-6 bg-white rounded-xl shadow-sm p-4 border border-gray-200">
                <h3 class="font-bold text-lg mb-2">Tentang Modul</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $module->description }}</p>
            </div>
            
        </div>
    </div>
</x-user-layout>