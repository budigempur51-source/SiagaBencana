<div class="relative w-full h-[400px] overflow-hidden rounded-b-[50px] shadow-2xl group">
    
    {{-- CSS ANIMASI (Langsung tanam disini biar aman & portable) --}}
    <style>
        .bg-3d-blue {
            background: radial-gradient(circle at top right, #60a5fa, #2563eb, #1e3a8a, #0f172a);
        }
        .animate-cyber-lines {
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255, 255, 255, 0.03) 10px, rgba(255, 255, 255, 0.03) 20px);
            animation: moveLines 20s linear infinite;
        }
        .animate-shine {
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: glowingShine 6s infinite ease-in-out;
        }
        @keyframes moveLines { 0% { transform: translateY(0); } 100% { transform: translateY(50px); } }
        @keyframes glowingShine { 0% { left: -100%; } 50%, 100% { left: 200%; } }
    </style>

    {{-- 1. BACKGROUND UTAMA (3D Blue) --}}
    <div class="absolute inset-0 bg-3d-blue"></div>
    
    {{-- 2. ANIMASI GARIS & CAHAYA --}}
    <div class="absolute inset-0 w-[200%] h-[200%] -top-1/2 -left-1/2 animate-cyber-lines z-0"></div>
    <div class="absolute inset-0 w-1/2 h-full skew-x-[-20deg] animate-shine z-0"></div>

    {{-- 3. KONTEN HERO --}}
    <div class="absolute inset-0 flex flex-col justify-center px-6 md:px-12 z-10">
        <div class="max-w-4xl mx-auto text-center md:text-left w-full flex flex-col md:flex-row items-center gap-8">
            
            {{-- Avatar Kategori (Floating Effect) --}}
            <div class="relative group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-blue-400 blur-xl opacity-30 rounded-full animate-pulse"></div>
                <div class="relative w-24 h-24 md:w-32 md:h-32 rounded-[30px] bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-2xl">
                    <span class="text-4xl md:text-5xl font-black text-white drop-shadow-lg">
                        {{ substr($category->name, 0, 1) }}
                    </span>
                </div>
            </div>

            {{-- Teks Sapaan Personal --}}
            <div class="text-white space-y-2 text-center md:text-left">
                <div class="inline-block px-4 py-1 rounded-full bg-blue-500/20 border border-blue-400/30 backdrop-blur-sm text-xs font-bold uppercase tracking-widest text-blue-200 mb-2">
                    Learning Hub
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
                    Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                </h1>
                <p class="text-blue-100 text-sm md:text-lg font-medium max-w-xl leading-relaxed opacity-90">
                    Kamu sedang menjelajahi topik <span class="text-white font-bold underline decoration-blue-400 decoration-2 underline-offset-4">{{ $category->name }}</span>. Yuk lanjutkan progres belajarmu hari ini.
                </p>

                {{-- Stats Badge --}}
                <div class="flex items-center justify-center md:justify-start gap-4 mt-4">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/></svg>
                        <span class="text-sm font-bold">{{ $videos->total() }} Video</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                        <span class="text-sm font-bold">{{ $modules->total() }} Modul</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>