<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-red-600 to-orange-500 rounded-3xl p-8 mb-8 text-white shadow-xl shadow-red-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="mt-2 opacity-90 font-medium">Anda memiliki akses penuh untuk mengelola konten edukasi bencana.</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kategori Materi</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">3</h4>
                    <div class="mt-4 flex items-center text-sm font-bold text-emerald-600">
                        <span>Aktif & Terpublish</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Topik</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">12</h4>
                    <div class="mt-4 flex items-center text-sm font-bold text-blue-600">
                        <span>Dalam 3 Kategori</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Video</p>
                    <h4 class="text-3xl font-black text-gray-900 mt-2">48</h4>
                    <div class="mt-4 flex items-center text-sm font-bold text-red-600">
                        <span>+5 Minggu ini</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100">
                <div class="p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Aksi Cepat Manajemen</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="#" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Tambah Video</span>
                        </a>
                        <a href="#" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="font-bold text-gray-700">Kelola Topik</span>
                        </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>