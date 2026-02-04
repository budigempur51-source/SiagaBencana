<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiagaBencana') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .glass-input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
            outline: none;
        }
        /* Animasi Background Bergerak Halus */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .floating-shape { animation: float 6s ease-in-out infinite; }
        .floating-shape-delayed { animation: float 8s ease-in-out infinite; animation-delay: 1s; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased overflow-hidden">
    
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0f172a]">
        
        {{-- BACKGROUND ELEMENTS --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            {{-- Gradient Base --}}
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900"></div>
            
            {{-- Grid Pattern Overlay --}}
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#ffffff 1px, transparent 1px), linear-gradient(90deg, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>

            {{-- Glowing Orbs (Animasi) --}}
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 floating-shape"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 floating-shape-delayed"></div>
            <div class="absolute top-[20%] right-[20%] w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-[96px] opacity-20 floating-shape"></div>
        </div>

        {{-- MAIN CONTENT CONTAINER --}}
        <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 glass-card shadow-2xl overflow-hidden sm:rounded-[2rem] transition-all duration-500 hover:shadow-blue-900/20">
            
            {{-- Logo Header --}}
            <div class="flex flex-col items-center mb-8">
                <a href="/" class="group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                    </div>
                </a>
                <h2 class="mt-4 text-2xl font-bold text-white tracking-tight">SiagaBencana</h2>
                <p class="text-sm text-slate-400">Portal Edukasi & Keselamatan</p>
            </div>

            {{-- Form Slot --}}
            <div class="relative">
                {{ $slot }}
            </div>
        </div>

        {{-- Footer Copyright --}}
        <div class="relative z-10 mt-8 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} SiagaBencana. All rights reserved.
        </div>
    </div>
</body>
</html>