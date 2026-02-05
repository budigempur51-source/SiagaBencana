<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 mb-8 text-white shadow-xl shadow-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="mt-2 opacity-90 font-medium">Platform Literasi Digital Mitigasi Bencana Banjir Aceh siap dikelola.</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['categories_count'] }}</h4>
                    <div class="mt-4 text-xs font-bold text-emerald-600 bg-emerald-50 inline-block px-2 py-1 rounded">
                        Materi Utama
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Topik</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['topics_count'] }}</h4>
                    <div class="mt-4 text-xs font-bold text-blue-600 bg-blue-50 inline-block px-2 py-1 rounded">
                        Sub-Materi
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Video Edukasi</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['videos_count'] }}</h4>
                    <div class="mt-4 text-xs font-bold text-red-600 bg-red-50 inline-block px-2 py-1 rounded">
                        Konten Visual
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Modul Belajar</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['modules_count'] }}</h4>
                    <div class="mt-4 text-xs font-bold text-amber-600 bg-amber-50 inline-block px-2 py-1 rounded">
                        Dokumen PDF
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100">
                <div class="p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Aksi Cepat Manajemen</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('videos.create') }}" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Upload Video</span>
                        </a>
                        <a href="{{ route('modules.create') }}" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Unggah Modul</span>
                        </a>
                        <a href="{{ route('topics.index') }}" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Kelola Topik</span>
                        </a>
                        <a href="{{ route('categories.index') }}" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Kategori</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>