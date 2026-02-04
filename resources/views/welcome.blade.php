<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SiagaBencana Aceh') }} - Literasi Digital Mitigasi Banjir</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Figtree', sans-serif; letter-spacing: -0.01em; }

        /* --- 1. GLASSMORPHISM PREMIUM (Kaca) --- */
        .glass-premium {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* --- 2. BUTTON GLOW --- */
        .btn-emerald-clean {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), inset 0 1px 0 rgba(255,255,255,0.2);
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-emerald-clean:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(16, 185, 129, 0.5);
            filter: brightness(1.1);
        }

        /* --- 3. TYPOGRAPHY --- */
        .hero-title {
            font-size: clamp(2.5rem, 7vw, 6rem);
            line-height: 1.1; /* Sedikit lebih longgar di HP */
            letter-spacing: -0.04em;
            font-weight: 900;
            text-shadow: 0 10px 40px rgba(0,0,0,0.4);
        }
        
        @media (min-width: 1024px) {
            .hero-title { line-height: 0.9; }
        }

        .text-shadow-sm {
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        /* --- 4. VIDEO OVERLAY --- */
        .vignette-master {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 50%, rgba(2,6,23,0.4) 0%, rgba(2,6,23,0.95) 100%);
            z-index: 2;
        }

        /* --- 5. SLIDER ANIMATION --- */
        .slide-item {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 1.2s ease-in-out;
            transform: translateX(30px) scale(0.95);
        }

        .slide-active {
            opacity: 1;
            transform: translateX(0) scale(1);
            z-index: 10;
        }
    </style>
</head>
<body class="antialiased bg-slate-950 text-white overflow-x-hidden selection:bg-emerald-500 selection:text-white">
    
    <nav class="fixed w-full z-50 transition-all duration-500 py-4 lg:py-6 top-0" id="mainNav">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3 lg:space-x-6">
                    <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo" class="h-10 md:h-16 lg:h-20 w-auto drop-shadow-[0_0_15px_rgba(16,185,129,0.4)]">
                    <div class="hidden sm:block border-l border-white/20 pl-4 md:pl-6">
                        <h2 class="text-sm md:text-2xl font-black uppercase tracking-tighter text-shadow-sm">SiagaBencana</h2>
                        <p class="text-[8px] md:text-[9px] font-bold text-emerald-400 uppercase tracking-[0.4em] text-shadow-sm">Aceh Digilitera</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 lg:space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-xs md:text-sm font-bold text-white/90 hover:text-emerald-400 transition text-shadow-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs md:text-sm font-bold text-white/90 hover:text-white transition text-shadow-sm hidden sm:inline-block">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-emerald-clean px-5 py-2 md:px-8 md:py-3.5 text-white text-[10px] md:text-sm font-black rounded-full shadow-2xl">
                            Daftar <span class="hidden sm:inline">Sekarang</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="vignette-master"></div>
            <video id="bgVideo" autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ asset('videos/hero-bg.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10 w-full pt-24 lg:pt-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                
                <div class="text-center lg:text-left order-1">
                    <div class="inline-flex items-center space-x-3 px-4 py-1.5 rounded-full glass-premium border-white/10 text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] mb-6 md:mb-10 backdrop-blur-md">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_#10b981]"></span>
                        <span>Literasi Digital Aceh</span>
                    </div>
                    
                    <h1 class="hero-title text-white mb-6 leading-tight">
                        Budaya<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 drop-shadow-lg">Siaga.</span>
                    </h1>
                    
                    <p class="text-base md:text-xl lg:text-2xl text-slate-200/90 leading-relaxed mb-10 max-w-lg mx-auto lg:mx-0 font-medium text-shadow-sm">
                        Membangun ketangguhan masyarakat Aceh melalui <span class="text-white font-bold border-b-2 border-emerald-500/50">Edukasi Digital</span> berbasis kearifan lokal yang presisi.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="btn-emerald-clean px-8 py-4 text-white text-sm md:text-lg font-black rounded-2xl w-full sm:w-auto">
                            Mulai Belajar
                        </a>
                        <a href="#tentang" class="glass-premium px-8 py-4 text-white text-sm md:text-lg font-bold rounded-2xl hover:bg-white/10 transition-all border border-white/10 w-full sm:w-auto">
                            Pelajari Program
                        </a>
                    </div>
                </div>

                <div class="hidden lg:flex relative h-[600px] lg:h-[700px] w-full pointer-events-none order-2 items-center justify-center">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-emerald-500/20 rounded-full blur-[100px] animate-pulse"></div>

                    <div class="slide-item slide-active">
                        <img src="{{ asset('avatar/slide1.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide2.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide3.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('avatar/slide4.png') }}" class="max-h-full w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce hidden lg:block z-20">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <section id="tentang" class="py-20 md:py-32 bg-white text-slate-950 relative z-30 rounded-t-[2.5rem] md:rounded-t-[5rem] -mt-10 lg:-mt-20 shadow-[0_-20px_60px_rgba(0,0,0,0.5)]">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-3xl text-center lg:text-left mx-auto lg:mx-0">
                    <h2 class="text-4xl md:text-6xl lg:text-7xl font-black tracking-tighter leading-[0.9] mb-6 uppercase">
                        Fokus Utama<br><span class="text-emerald-600">Literasi Kami.</span>
                    </h2>
                    <p class="text-lg md:text-2xl text-slate-500 font-light max-w-xl mx-auto lg:mx-0">Strategi tepat sasaran untuk mewujudkan Aceh yang lebih tangguh menghadapi bencana.</p>
                </div>
                <div class="hidden lg:block h-2 w-32 bg-emerald-500 rounded-full mb-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                <div class="glass-card p-8 md:p-12 rounded-[2rem] hover:bg-white hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-500 group border border-slate-100">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-3xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-2xl font-black mb-3 tracking-tight text-slate-800">Edukasi Digital</h3>
                    <p class="text-base text-slate-500 leading-relaxed">Modul pembelajaran berbasis video dan interaksi untuk semua usia, mudah diakses di mana saja.</p>
                </div>

                <div class="glass-card p-8 md:p-12 rounded-[2rem] hover:bg-white hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 group border border-slate-100">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-3xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-2xl font-black mb-3 tracking-tight text-slate-800">Aset Lokal</h3>
                    <p class="text-base text-slate-500 leading-relaxed">Penyelamatan aset budaya dan ekonomi berbasis platform digital agar tidak hilang saat bencana.</p>
                </div>

                <div class="glass-card p-8 md:p-12 rounded-[2rem] hover:bg-white hover:shadow-2xl hover:shadow-rose-500/10 transition-all duration-500 group border border-slate-100">
                    <div class="w-16 h-16 bg-rose-600 text-white rounded-3xl flex items-center justify-center mb-6 shadow-lg shadow-rose-500/30 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-2xl font-black mb-3 tracking-tight text-slate-800">Cepat Tanggap</h3>
                    <p class="text-base text-slate-500 leading-relaxed">Integrasi data relawan real-time untuk koordinasi lapangan yang efisien dan terukur.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-16 bg-white border-t border-slate-100 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <img src="{{ asset('avatar/logoweb.png') }}" alt="Logo" class="h-10 md:h-16 w-auto mx-auto mb-8 grayscale opacity-30 hover:opacity-100 transition-all duration-700 cursor-pointer">
            <div class="flex flex-wrap justify-center gap-6 md:gap-10 mb-8 text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">
                <a href="#" class="hover:text-emerald-500 transition">Beranda</a>
                <a href="#tentang" class="hover:text-emerald-500 transition">Tentang</a>
                <a href="#" class="hover:text-emerald-500 transition">Kontak</a>
            </div>
            <p class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Program Mahasiswa Berdampak Aceh.
            </p>
        </div>
    </footer>

    <script>
        // --- 1. Navbar Scroll Styling ---
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('glass-premium', 'py-3', 'shadow-2xl');
                nav.classList.remove('py-4', 'lg:py-6');
            } else {
                nav.classList.remove('glass-premium', 'py-3', 'shadow-2xl');
                nav.classList.add('py-4', 'lg:py-6');
            }
        });

        // --- 2. Slider (Otomatis Stop di HP karena hidden) ---
        let current = 0;
        const items = document.querySelectorAll('.slide-item');
        
        function rotate() {
            // Cek apakah slider visible (Desktop only)
            if(items.length > 0 && window.innerWidth >= 1024) { 
                items[current].classList.remove('slide-active');
                current = (current + 1) % items.length;
                items[current].classList.add('slide-active');
            }
        }
        setInterval(rotate, 5000);

        // --- 3. iOS Video Autoplay Fix ---
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('bgVideo');
            const forcePlay = () => {
                if (video && video.paused) {
                    video.play().then(() => removeListeners()).catch(e => console.log("Waiting interaction..."));
                }
            };
            const removeListeners = () => {
                document.removeEventListener('touchstart', forcePlay);
                document.removeEventListener('click', forcePlay);
            };
            forcePlay();
            document.addEventListener('touchstart', forcePlay, { passive: true });
            document.addEventListener('click', forcePlay);
        });
    </script>
</body>
</html>