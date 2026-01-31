<x-guest-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center p-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-800 mb-4">Pilih Jalur Belajar Anda</h1>
            <p class="text-slate-500 max-w-md mx-auto">Selamat datang! Silakan pilih kategori literasi digital mitigasi bencana yang sesuai dengan kebutuhan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full">
            @foreach($categories as $category)
                <a href="{{ route('user.hub', $category->slug) }}" class="group relative bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-b-8" style="border-bottom-color: {{ $category->color }};">
                    <div class="w-16 h-16 rounded-2xl mb-6 flex items-center justify-center text-white text-2xl font-bold" style="background-color: {{ $category->color }};">
                        {{ substr($category->name, 0, 1) }}
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">{{ $category->name }}</h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $category->description ?? 'Materi literasi digital khusus untuk kelompok ' . $category->name }}</p>
                    
                    <div class="flex items-center text-sm font-bold group-hover:gap-2 transition-all" style="color: {{ $category->color }};">
                        Mulai Belajar 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-guest-layout>