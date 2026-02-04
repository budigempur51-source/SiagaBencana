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
                
                {{-- Stats --}}
                <div class="flex gap-4 mt-3 text-xs md:text-sm font-semibold text-white/70 uppercase tracking-wider">
                    <span>{{ $videos->total() }} Video</span>
                    <span>•</span>
                    <span>{{ $modules->total() }} Modul Bacaan</span>
                </div>
            </div>
        </div>
    </div>
</div>