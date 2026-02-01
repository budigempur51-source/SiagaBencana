<x-user-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        {{-- Background Decoration --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-blue-100 rounded-full blur-3xl opacity-40"></div>
            <div class="absolute top-[30%] -right-[10%] w-[40%] h-[40%] bg-emerald-100 rounded-full blur-3xl opacity-40"></div>
        </div>

        <div class="text-center max-w-3xl mx-auto mb-16 relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-xs font-bold mb-4 border border-blue-100">Selamat Datang, {{ Auth::user()->name }}!</span>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight sm:text-6xl mb-6 leading-tight">
                Pilih Jalur <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-emerald-500">Belajar Anda.</span>
            </h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto">
                Materi disesuaikan dengan kebutuhan spesifik Anda. Silakan pilih kategori di bawah ini untuk memulai pengalaman belajar yang interaktif.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-7xl relative z-10 px-4">
            @foreach($categories as $category)
                @php
                    $colorClass = match($category->slug) {
                        'anak-anak' => 'from-blue-500 to-cyan-400 shadow-blue-200/50',
                        'umkm' => 'from-orange-500 to-amber-400 shadow-orange-200/50',
                        'kesehatan' => 'from-emerald-500 to-teal-400 shadow-emerald-200/50',
                        default => 'from-gray-500 to-slate-400 shadow-gray-200/50'
                    };
                    
                    // Icon logic sama seperti sebelumnya...
                     $icon = match($category->slug) {
                        'anak-anak' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                        'umkm' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>',
                        'kesehatan' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>',
                        default => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>'
                    };
                @endphp

                <a href="{{ route('user.hub', $category->slug) }}" 
                   class="group relative bg-white rounded-[2rem] p-1 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $colorClass }} rounded-[2rem] opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl -z-10"></div>
                    
                    <div class="h-full bg-white rounded-[1.8rem] p-8 overflow-hidden relative border border-slate-100 group-hover:border-transparent transition-colors">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $colorClass }} flex items-center justify-center text-white shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                            {!! $icon !!}
                        </div>

                        <h3 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r {{ $colorClass }}">
                            {{ $category->name }}
                        </h3>
                        
                        <p class="text-slate-500 text-sm mb-8 leading-relaxed line-clamp-3">
                            {{ $category->description }}
                        </p>

                        <div class="flex items-center justify-between border-t border-slate-50 pt-6">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Konten</span>
                                <span class="text-lg font-black text-slate-800">{{ $category->videos_count }} <span class="text-xs font-normal text-slate-400">Video</span></span>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-900 group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-user-layout>