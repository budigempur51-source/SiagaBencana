<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiagaBencana Aceh - Literasi Digital Mitigasi Banjir</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,600,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Figtree', sans-serif; letter-spacing: -0.01em; }

        /* Kaca Ultra Clean */
        .glass-premium {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Tombol Hijau Clean & Glow */
        .btn-emerald-clean {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4), inset 0 1px 1px rgba(255,255,255,0.2);
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-emerald-clean:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.6);
            filter: brightness(1.1);
        }

        /* Tulisan Anti-Kabur & Super Bold */
        .hero-title {
            font-size: clamp(3rem, 8vw, 7.5rem);
            line-height: 0.85;
            letter-spacing: -0.05em;
            font-weight: 900;
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .text-sharp-light {
            text-shadow: 0 2px 10px rgba(0,0,0,0.8);
            -webkit-font-smoothing: antialiased;
        }

        /* Video Background Master Overlay */
        .vignette-master {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 50%, rgba(2,6,23,0.4) 0%, rgba(2,6,23,0.9) 100%);
            z-index: 2;
        }

        /* Slider Animation */
        .slide-item {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(50px) scale(0.9);
        }

        .slide-active {
            opacity: 1;
            transform: translateX(0) scale(1);
            z-index: 10;
        }
    </style>
</head>
<body class="antialiased bg-slate-950 text-white overflow-x-hidden">
    
    <nav class="fixed w-full z-50 transition-all duration-500 py-6" id="mainNav">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo" class="h-20 w-auto drop-shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                    <div class="hidden sm:block border-l border-white/20 pl-6">
                        <h2 class="text-2xl font-black uppercase tracking-tighter text-sharp-light">SiagaBencana</h2>
                        <p class="text-[9px] font-bold text-emerald-400 uppercase tracking-[0.5em] text-sharp-light">Aceh Digilitera</p>
                    </div>
                </div>

                <div class="flex items-center space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-white/80 hover:text-emerald-400 transition text-sharp-light">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-white/80 hover:text-white transition text-sharp-light">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-emerald-clean px-8 py-3.5 text-white text-sm font-black rounded-full">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative h-screen w-full flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="vignette-master"></div>
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ asset('videos/hero-bg.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10 w-full pt-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-left">
                    <div class="inline-flex items-center space-x-3 px-4 py-1.5 rounded-full glass-premium border-white/10 text-emerald-400 text-[10px] font-black uppercase tracking-[0.4em] mb-10">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Literasi Digital Aceh</span>
                    </div>
                    
                    <h1 class="hero-title text-white mb-10">
                        Budaya<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Siaga.</span>
                    </h1>
                    
                    <p class="text-xl lg:text-2xl text-slate-200/90 leading-relaxed mb-12 max-w-lg font-medium text-sharp-light">
                        Membangun ketangguhan masyarakat Aceh melalui <span class="text-white font-bold italic">Edukasi Digital</span> berbasis kearifan lokal yang presisi.
                    </p>
                    
                    <div class="flex flex-wrap gap-6">
                        <a href="{{ route('login') }}" class="btn-emerald-clean px-12 py-5 text-white text-lg font-black rounded-2xl">
                            Mulai Belajar
                        </a>
                        <a href="#tentang" class="glass-premium px-12 py-5 text-white text-lg font-bold rounded-2xl hover:bg-white/5 transition-all">
                            Pelajari Program
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block relative h-[700px] w-full pointer-events-none">
                    <div class="slide-item slide-active">
                        <img src="{{ asset('avatar/slide1.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_40px_70px_rgba(0,0,0,0.7)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide2.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_40px_70px_rgba(0,0,0,0.7)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide3.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_40px_70px_rgba(0,0,0,0.7)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide4.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_40px_70px_rgba(0,0,0,0.7)]">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-32 bg-white text-slate-950 relative z-30">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-24 gap-8">
                <div class="max-w-3xl">
                    <h2 class="text-5xl lg:text-7xl font-black tracking-tighter leading-[0.9] mb-8 uppercase">
                        Fokus Utama<br><span class="text-emerald-600">Literasi Kami.</span>
                    </h2>
                    <p class="text-2xl text-slate-500 font-light max-w-xl">Strategi tepat sasaran untuk mewujudkan Aceh yang lebih tangguh menghadapi bencana.</p>
                </div>
                <div class="h-2 w-32 bg-emerald-500 rounded-full mb-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="p-12 rounded-[3.5rem] bg-slate-50 border border-slate-100 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-emerald-500 text-white rounded-3xl flex items-center justify-center mb-10 shadow-lg shadow-emerald-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-3xl font-black mb-6 tracking-tight">Edukasi Digital</h3>
                    <p class="text-lg text-slate-500 leading-relaxed">Modul pembelajaran berbasis video dan interaksi untuk semua usia.</p>
                </div>

                <div class="p-12 rounded-[3.5rem] bg-slate-50 border border-slate-100 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-3xl flex items-center justify-center mb-10 shadow-lg shadow-blue-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-3xl font-black mb-6 tracking-tight">Aset Lokal</h3>
                    <p class="text-lg text-slate-500 leading-relaxed">Penyelamatan aset budaya dan ekonomi berbasis platform digital.</p>
                </div>

                <div class="p-12 rounded-[3.5rem] bg-slate-50 border border-slate-100 hover:shadow-2xl hover:shadow-rose-500/10 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-rose-600 text-white rounded-3xl flex items-center justify-center mb-10 shadow-lg shadow-rose-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-3xl font-black mb-6 tracking-tight">Cepat Tanggap</h3>
                    <p class="text-lg text-slate-500 leading-relaxed">Integrasi data relawan real-time untuk koordinasi lapangan yang efisien.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-24 bg-white border-t border-slate-100 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo" class="h-16 w-auto mx-auto mb-10 grayscale opacity-30 hover:opacity-100 transition-all duration-700">
            <div class="flex justify-center space-x-10 mb-10 text-sm font-bold text-slate-400 uppercase tracking-widest">
                <a href="#" class="hover:text-emerald-500 transition">Beranda</a>
                <a href="#" class="hover:text-emerald-500 transition">Tentang</a>
                <a href="#" class="hover:text-emerald-500 transition">Kontak</a>
            </div>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Program Mahasiswa Berdampak Aceh.
            </p>
        </div>
    </footer>

    <script>
        // Navbar Scroll Styling
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 80) {
                nav.classList.add('glass-premium', 'py-4', 'shadow-2xl');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glass-premium', 'py-4', 'shadow-2xl');
                nav.classList.add('py-6');
            }
        });

        // Precision Image Slider
        let current = 0;
        const items = document.querySelectorAll('.slide-item');
        
        function rotate() {
            items[current].classList.remove('slide-active');
            current = (current + 1) % items.length;
            items[current].classList.add('slide-active');
        }

        setInterval(rotate, 5000); // Ganti setiap 5 detik agar tidak terlalu cepat
    </script>
</body>
</html>