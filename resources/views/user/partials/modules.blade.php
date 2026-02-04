<div x-show="activeTab === 'modul'" style="display: none;" x-transition:enter="transition ease-out duration-300 opacity-0 translate-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($modules as $module)
            <div class="bg-white rounded-2xl border border-slate-200 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
                
                {{-- Decorative Top Line --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 z-10"></div>

                {{-- COVER IMAGE AREA --}}
                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden border-b border-slate-100">
                    @if($module->cover_image)
                        {{-- Jika ada Cover Image --}}
                        <img src="{{ asset('storage/' . $module->cover_image) }}" 
                             alt="{{ $module->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        {{-- Placeholder Default Jika Tidak Ada Cover --}}
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50">
                            <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">E-Book</span>
                        </div>
                    @endif

                    {{-- Type Badge Overlay --}}
                    <div class="absolute top-3 left-3">
                         <span class="text-[10px] font-bold text-slate-600 bg-white/90 backdrop-blur-sm px-2 py-1 rounded shadow-sm uppercase tracking-wide ring-1 ring-slate-200">
                            {{ $module->file_type ?? 'PDF' }}
                        </span>
                    </div>
                </div>

                {{-- CONTENT BODY --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2 leading-tight">{{ $module->title }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed line-clamp-2 mb-4">{{ $module->summary }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-medium text-slate-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $module->created_at->format('d M Y') }}
                        </span>
                        
                        {{-- Tombol BACA --}}
                        <a href="{{ route('user.module.read', $module->slug) }}" 
                           class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 hover:text-blue-800 transition bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg">
                            Baca
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
             {{-- Empty State Modul --}}
             <div class="col-span-full py-24 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
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