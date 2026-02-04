<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk / Daftar - {{ config('app.name', 'SiagaBencana') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Figtree', 'sans-serif'] },
                    colors: {
                        'siaga-blue': '#2563eb',
                        'siaga-dark': '#0f172a'
                    },
                    borderRadius: {
                        'super': '40px',
                        'input': '20px', 
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Background & Animasi (Sama seperti sebelumnya) */
        .bg-3d-blue {
            background: radial-gradient(circle at top right, #60a5fa, #2563eb, #1e3a8a, #0f172a);
            position: relative;
            overflow: hidden;
        }
        .bg-3d-blue::before {
            content: ""; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255, 255, 255, 0.05) 10px, rgba(255, 255, 255, 0.05) 20px);
            animation: moveLines 20s linear infinite; z-index: 1;
        }
        .bg-3d-blue::after {
            content: ""; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.15), transparent);
            transform: skewX(-20deg); animation: glowingShine 6s infinite ease-in-out; z-index: 2;
        }
        @keyframes moveLines { 0% { transform: translateY(0); } 100% { transform: translateY(50px); } }
        @keyframes glowingShine { 0% { left: -100%; } 50%, 100% { left: 200%; } }
        .header-content { position: relative; z-index: 10; }

        /* Layout Desktop */
        body { background-color: #f1f5f9; font-family: 'Figtree', sans-serif; }
        .desktop-container {
            position: relative; overflow: hidden; width: 100%; max-width: 1000px; min-height: 650px;
            background: #fff; border-radius: 40px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
            display: none;
        }
        .form-container { position: absolute; top: 0; height: 100%; transition: all 0.6s ease-in-out; }
        .sign-in-container { left: 0; width: 50%; z-index: 2; }
        .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
        .desktop-container.right-panel-active .sign-in-container { transform: translateX(100%); }
        .desktop-container.right-panel-active .sign-up-container { transform: translateX(100%); opacity: 1; z-index: 5; animation: show 0.6s; }
        @keyframes show { 0%, 49.99% { opacity: 0; z-index: 1; } 50%, 100% { opacity: 1; z-index: 5; } }
        
        .overlay-container {
            position: absolute; top: 0; left: 50%; width: 50%; height: 100%; overflow: hidden;
            transition: transform 0.6s ease-in-out; z-index: 100; border-radius: 0 40px 40px 0;
        }
        .desktop-container.right-panel-active .overlay-container { transform: translateX(-100%); border-radius: 40px 0 0 40px; }
        .overlay {
            color: #ffffff; position: relative; left: -100%; height: 100%; width: 200%;
            transform: translateX(0); transition: transform 0.6s ease-in-out;
        }
        .desktop-container.right-panel-active .overlay { transform: translateX(50%); }
        .overlay-panel {
            position: absolute; display: flex; align-items: center; justify-content: center;
            flex-direction: column; padding: 0 40px; text-align: center;
            top: 0; height: 100%; width: 50%; transform: translateX(0); transition: transform 0.6s ease-in-out;
        }
        .overlay-left { transform: translateX(-20%); }
        .desktop-container.right-panel-active .overlay-left { transform: translateX(0); }
        .overlay-right { right: 0; transform: translateX(0); }
        .desktop-container.right-panel-active .overlay-right { transform: translateX(20%); }

        /* Layout Mobile */
        .mobile-wrapper {
            display: none; position: relative; width: 100%; max-width: 420px; overflow: hidden;
            border-radius: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); background: white; min-height: 80vh;
        }
        .mobile-track { display: flex; width: 200%; transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55); }
        .mobile-card { width: 50%; display: flex; flex-direction: column; }
        .mobile-header { padding: 40px 30px; border-bottom-left-radius: 40px; border-bottom-right-radius: 40px; text-align: center; color: white; flex-shrink: 0; }
        .mobile-body { padding: 30px; flex-grow: 1; background: white; display: flex; flex-direction: column; justify-content: center; }

        @media (min-width: 1024px) {
            .desktop-container { display: block; } .mobile-wrapper { display: none; }
            body { height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        }
        @media (max-width: 1023px) {
            .desktop-container { display: none; } .mobile-wrapper { display: block; margin: 20px auto; }
            body { padding: 10px; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        }
        
        /* Helper Class untuk Error */
        .input-error { border-color: #ef4444 !important; color: #ef4444 !important; }
        .input-error:focus { --tw-ring-color: #ef4444 !important; border-color: #ef4444 !important; }
    </style>
</head>
<body>

    <div class="desktop-container" id="desktopContainer">
        
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}" class="h-full flex flex-col justify-center items-center px-10 text-center bg-white">
                @csrf
                <h1 class="font-extrabold text-3xl mb-2 text-siaga-dark">Buat Akun Baru</h1>
                <span class="text-sm text-slate-400 mb-6">Lengkapi data diri untuk bergabung</span>
                
                <input type="text" name="name" placeholder="Nama Lengkap" class="bg-slate-50 border border-slate-200 rounded-input px-5 py-3 mb-3 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                <input type="email" name="email" placeholder="Email" class="bg-slate-50 border border-slate-200 rounded-input px-5 py-3 mb-3 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                
                <div class="w-full text-left mb-3">
                    <input id="passDesktop" type="password" name="password" placeholder="Password (Min. 8 Karakter)" 
                           class="bg-slate-50 border border-slate-200 rounded-input px-5 py-3 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none transition-all duration-300" required />
                    <p id="errDesktop" class="text-red-500 text-xs mt-1 ml-2 font-bold hidden"> Password Minimal 8 karakter </p>
                </div>
                
                <input type="password" name="password_confirmation" placeholder="Ulangi Password" class="bg-slate-50 border border-slate-200 rounded-input px-5 py-3 mb-6 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />

                <button class="rounded-full bg-siaga-blue text-white font-bold uppercase px-12 py-3 shadow-lg hover:bg-blue-700 transition transform active:scale-95 text-xs tracking-widest">Daftar Sekarang</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}" class="h-full flex flex-col justify-center items-center px-10 text-center bg-white">
                @csrf
                <h1 class="font-extrabold text-3xl mb-2 text-siaga-dark">Selamat Datang</h1>
                <span class="text-sm text-slate-400 mb-8">Masuk untuk melanjutkan pembelajaran</span>
                
                <input type="email" name="email" placeholder="Email" class="bg-slate-50 border border-slate-200 rounded-input px-5 py-4 mb-4 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                <input type="password" name="password" placeholder="Password" class="bg-slate-50 border border-slate-200 rounded-input px-5 py-4 mb-2 w-full text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                
                <a href="{{ route('password.request') }}" class="text-xs text-slate-500 hover:text-siaga-blue mb-8 w-full text-right font-bold">Lupa Password?</a>
                <button class="rounded-full bg-siaga-blue text-white font-bold uppercase px-12 py-3 shadow-lg hover:bg-blue-700 transition transform active:scale-95 text-xs tracking-widest">Masuk Akun</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay bg-3d-blue">
                <div class="overlay-panel overlay-left header-content">
                    <img src="{{ asset('avatar/logoweb.png') }}" class="w-32 mb-6 brightness-0 invert drop-shadow-xl" alt="Logo">
                    <h1 class="font-bold text-3xl mb-4">Sudah Punya Akun?</h1>
                    <p class="mb-8 text-blue-100 text-sm px-8">Silakan masuk kembali untuk mengakses materi kebencanaan.</p>
                    <button class="border-2 border-white bg-transparent rounded-full px-12 py-3 font-bold uppercase text-xs hover:bg-white hover:text-siaga-blue transition" id="signInDesktop">Masuk Disini</button>
                </div>
                <div class="overlay-panel overlay-right header-content">
                    <img src="{{ asset('avatar/logoweb.png') }}" class="w-32 mb-6 brightness-0 invert drop-shadow-xl" alt="Logo">
                    <h1 class="font-bold text-3xl mb-4">Halo, Sobat!</h1>
                    <p class="mb-8 text-blue-100 text-sm px-8">Belum terdaftar? Bergabunglah sekarang untuk akses lengkap modul.</p>
                    <button class="border-2 border-white bg-transparent rounded-full px-12 py-3 font-bold uppercase text-xs hover:bg-white hover:text-siaga-blue transition" id="signUpDesktop">Daftar Disini</button>
                </div>
            </div>
        </div>
    </div>


    <div class="mobile-wrapper">
        <div class="mobile-track" id="mobileTrack">
            
            <div class="mobile-card">
                <div class="mobile-header bg-3d-blue">
                    <div class="header-content flex flex-col items-center">
                        <img src="{{ asset('avatar/logoweb.png') }}" class="w-20 mb-4 brightness-0 invert drop-shadow-lg" alt="Logo">
                        <h2 class="text-2xl font-bold">Selamat Datang!</h2>
                        <p class="text-blue-100 text-xs mt-2 opacity-90">Masuk untuk mulai belajar</p>
                    </div>
                </div>
                
                <div class="mobile-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-4">
                            <input type="email" name="email" placeholder="Email Address" class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-4 text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                            <input type="password" name="password" placeholder="Password" class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-4 text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                        </div>
                        
                        <div class="flex justify-end mt-3 mb-6">
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-slate-400 hover:text-siaga-blue">Lupa Password?</a>
                        </div>

                        <button class="w-full rounded-full bg-siaga-blue text-white font-bold uppercase py-4 shadow-lg hover:bg-blue-700 active:scale-95 transition text-xs tracking-widest">
                            Masuk
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-xs text-slate-400 mb-3">Belum punya akun?</p>
                        <button id="toRegisterMobile" class="w-full border border-siaga-blue text-siaga-blue rounded-full py-3 font-bold text-xs hover:bg-blue-50 transition">
                            DAFTAR AKUN BARU
                        </button>
                    </div>
                </div>
            </div>

            <div class="mobile-card">
                <div class="mobile-header bg-3d-blue">
                    <div class="header-content flex flex-col items-center">
                        <img src="{{ asset('avatar/logoweb.png') }}" class="w-20 mb-4 brightness-0 invert drop-shadow-lg" alt="Logo">
                        <h2 class="text-2xl font-bold">Buat Akun Baru</h2>
                        <p class="text-blue-100 text-xs mt-2 opacity-90">Lengkapi data diri Anda</p>
                    </div>
                </div>

                <div class="mobile-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="space-y-3">
                            <input type="text" name="name" placeholder="Nama Lengkap" class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-3 text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                            <input type="email" name="email" placeholder="Email Address" class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-3 text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                            
                            <div class="w-full">
                                <input id="passMobile" type="password" name="password" placeholder="Password (Min. 8 Karakter)" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-3 text-sm focus:ring-2 focus:ring-siaga-blue outline-none transition-all duration-300" required minlength="8" />
                                <p id="errMobile" class="text-red-500 text-xs mt-1 ml-2 font-bold hidden">Password Minimal 8 karakter </p>
                            </div>
                            
                            <input type="password" name="password_confirmation" placeholder="Ulangi Password" class="w-full bg-slate-50 border border-slate-200 rounded-input px-5 py-3 text-sm focus:ring-2 focus:ring-siaga-blue outline-none" required />
                        </div>

                        <button class="w-full mt-6 rounded-full bg-siaga-blue text-white font-bold uppercase py-4 shadow-lg hover:bg-blue-700 active:scale-95 transition text-xs tracking-widest">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-xs text-slate-400 mb-3">Sudah punya akun?</p>
                        <button id="toLoginMobile" class="w-full border border-slate-300 text-slate-500 rounded-full py-3 font-bold text-xs hover:bg-slate-50 transition">
                            MASUK DISINI
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        /* =====================================
           LOGIKA VALIDASI PASSWORD (MERAH)
           ===================================== */
        function setupPasswordValidation(inputId, errorId) {
            const input = document.getElementById(inputId);
            const errorMsg = document.getElementById(errorId);

            if(input && errorMsg) {
                input.addEventListener('input', function() {
                    const val = this.value;
                    // Logic: Kalau ada isi TAPI kurang dari 8 karakter -> ERROR
                    if(val.length > 0 && val.length < 8) {
                        // Tambah Kelas Error (Merah)
                        this.classList.add('input-error'); 
                        this.classList.remove('focus:ring-siaga-blue');
                        // Munculkan Pesan
                        errorMsg.classList.remove('hidden');
                    } else {
                        // Hapus Kelas Error (Balik Biru)
                        this.classList.remove('input-error');
                        this.classList.add('focus:ring-siaga-blue');
                        // Sembunyikan Pesan
                        errorMsg.classList.add('hidden');
                    }
                });
            }
        }

        // Jalankan Validasi untuk Desktop & Mobile
        setupPasswordValidation('passDesktop', 'errDesktop');
        setupPasswordValidation('passMobile', 'errMobile');

        /* =====================================
           LOGIKA ANIMASI SLIDER (TETAP ADA)
           ===================================== */
        /* 1. Logic Desktop (Overlay Sliding) */
        const desktopContainer = document.getElementById('desktopContainer');
        const signUpBtnDesktop = document.getElementById('signUpDesktop');
        const signInBtnDesktop = document.getElementById('signInDesktop');

        if(signUpBtnDesktop && signInBtnDesktop) {
            signUpBtnDesktop.addEventListener('click', () => {
                desktopContainer.classList.add("right-panel-active");
            });
            signInBtnDesktop.addEventListener('click', () => {
                desktopContainer.classList.remove("right-panel-active");
            });
        }

        /* 2. Logic Mobile (Track Sliding) */
        const mobileTrack = document.getElementById('mobileTrack');
        const toRegisterMobile = document.getElementById('toRegisterMobile');
        const toLoginMobile = document.getElementById('toLoginMobile');

        if(toRegisterMobile && toLoginMobile) {
            toRegisterMobile.addEventListener('click', () => {
                mobileTrack.style.transform = "translateX(-50%)";
            });
            toLoginMobile.addEventListener('click', () => {
                mobileTrack.style.transform = "translateX(0%)";
            });
        }
    </script>
</body>
</html>