<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiagaBencana Aceh - Literasi Digital Mitigasi Banjir</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white text-slate-900 font-sans">
    
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo SiagaBencana" class="h-12 w-auto">
                    <div class="hidden sm:block">
                        <span class="block text-lg font-black leading-none text-slate-800 uppercase tracking-tighter">SiagaBencana</span>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Aceh Digilitera</span>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-full hover:bg-slate-800 transition">Daftar Akun</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold mb-6 border border-emerald-100 uppercase tracking-wider">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    Program Mahasiswa Berdampak Aceh
                </div>
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                    Budaya Lokal, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-emerald-500">Literasi Digital,</span> <br>
                    Aceh Siaga Banjir.
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed mb-10 max-w-xl">
                    Platform edukasi mitigasi bencana banjir berbasis kearifan lokal. Lindungi keluarga dan masyarakat Aceh melalui pemahaman teknologi digital yang tepat guna.
                </p>
                
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    @auth
                        <a href="{{ route('user.selection') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white text-lg font-extrabold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300">
                            Yok Belajar Sekarang!
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white text-lg font-extrabold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300">
                            Yok Belajar Sekarang!
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @endauth
                    <a href="#tentang" class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-700 text-lg font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all">
                        Pelajari Program
                    </a>
                </div>
            </div>
        </div>
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-1/2 h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#3B82F6" d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-46.1C87.4,-33.1,90,-16.5,87.7,-0.7C85.4,15.2,78.1,30.3,68.8,43.4C59.5,56.5,48.2,67.6,34.8,73.5C21.4,79.4,5.9,80.1,-10.1,77.3C-26.1,74.5,-42.6,68.3,-56.3,58.3C-70,48.3,-80.9,34.5,-85.4,19.1C-89.9,3.7,-88,-13.4,-81.4,-28.3C-74.8,-43.2,-63.5,-55.9,-50.3,-63.5C-37.1,-71.1,-22,-73.6,-6.6,-72.5C8.8,-71.3,21.6,-76.6,30.6,-83.6C39.6,-90.6,44.7,-99.3,44.7,-76.4Z" transform="translate(100 100)" />
            </svg>
        </div>
    </section>

    <section id="tentang" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Tiga Fokus Literasi Digital</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Kami menyajikan materi yang tersegmentasi untuk menjamin pemahaman yang relevan bagi setiap lapisan masyarakat Aceh.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 text-left">Anak-Anak</h3>
                    <p class="text-slate-500 leading-relaxed text-left text-sm">
                        Edukasi visual dan cerita interaktif untuk mengenalkan tanda-tanda banjir sejak dini melalui perangkat digital.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 text-left">UMKM Aceh</h3>
                    <p class="text-slate-500 leading-relaxed text-left text-sm">
                        Strategi penyelamatan aset bisnis dan pemanfaatan platform digital untuk menjaga keberlanjutan usaha saat terjadi bencana.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 text-left">Relawan Kesehatan</h3>
                    <p class="text-slate-500 leading-relaxed text-left text-sm">
                        Manajemen data korban dan pelaporan kesehatan berbasis aplikasi untuk respon cepat tanggap darurat banjir.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 bg-white border-t border-slate-100 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo Footer" class="h-10 w-auto mx-auto mb-6 grayscale opacity-50">
            <p class="text-sm text-slate-400 font-medium tracking-wide">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Pengembangan Platform Literasi Digital Berbasis Budaya Lokal.
            </p>
        </div>
    </footer>
</body>
</html>