<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiagaBencana - Platform Edukasi Kebencanaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-figtree">
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg shadow-red-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">Siaga<span class="text-red-600">Bencana</span></span>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-red-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-red-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 transition ease-in-out duration-150">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                    Waspada Sejak Dini, <span class="text-red-600 text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500">Selamatkan Sesama.</span>
                </h1>
                <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                    Platform edukasi kebencanaan terpadu untuk anak-anak, pelaku ekonomi, dan relawan kesehatan. Pelajari cara bertahan dan pulih dari situasi darurat.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#kategori" class="px-8 py-4 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition shadow-xl shadow-gray-200">Mulai Belajar</a>
                    <a href="#" class="px-8 py-4 bg-white text-gray-900 border border-gray-200 rounded-xl font-bold hover:bg-gray-50 transition">Lihat Panduan</a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-red-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
        </div>
    </section>

    <section id="kategori" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Kategori Edukasi</h2>
                    <p class="text-gray-500 mt-2">Materi khusus yang dirancang untuk berbagai kalangan.</p>
                </div>
                <a href="#" class="text-red-600 font-semibold hover:underline">Lihat Semua Materi &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 rounded-3xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-2xl hover:shadow-amber-100 transition duration-300">
                    <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Anak-Anak</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">Cerita dan animasi interaktif untuk mengenalkan bahaya bencana sejak dini dengan cara yang ceria.</p>
                    <button class="font-bold text-amber-600">Jelajahi &rarr;</button>
                </div>

                <div class="group p-8 rounded-3xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-2xl hover:shadow-blue-100 transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">UMKM & Ekonomi</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">Panduan praktis melindungi aset usaha dan strategi pemulihan ekonomi pasca bencana bagi pedagang.</p>
                    <button class="font-bold text-blue-600">Jelajahi &rarr;</button>
                </div>

                <div class="group p-8 rounded-3xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-2xl hover:shadow-emerald-100 transition duration-300">
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kesehatan & Relawan</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">Prosedur P3K, manajemen logistik bantuan, dan kesehatan mental di area terdampak bencana.</p>
                    <button class="font-bold text-emerald-600">Jelajahi &rarr;</button>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 py-12 text-center text-gray-500 text-sm border-t border-gray-800">
        <p>&copy; 2026 SiagaBencana. Built with professional standards.</p>
    </footer>
</body>
</html>