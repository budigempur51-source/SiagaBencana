<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <nav class="flex text-sm text-slate-400 mb-2">
                    <a href="{{ route('user.selection') }}" class="hover:text-blue-600">Jalur Belajar</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-600 font-medium">{{ $category->name }}</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-900">Edukasi {{ $category->name }}</h1>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="relative w-full md:w-96">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari video atau modul..." class="w-full pl-12 pr-4 py-3 bg-white border-none rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                <svg class="w-5 h-5 absolute left-4 top-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>
        </div>

        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Video Pembelajaran
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($videos as $video)
                    <div class="group cursor-pointer">
                        <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-200 mb-3 shadow-sm group-hover:shadow-lg transition">
                            <img src="{{ $video->getThumbnailUrl() }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute bottom-2 right-2 px-2 py-1 bg-black/70 text-white text-[10px] font-bold rounded">
                                {{ $video->duration }} Menit
                            </div>
                        </div>
                        <h3 class="font-bold text-slate-800 line-clamp-2 group-hover:text-blue-600 transition">{{ $video->title }}</h3>
                        <p class="text-xs text-slate-500 mt-1 uppercase font-semibold tracking-wider">{{ $video->level }}</p>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 italic">Belum ada video untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.993 7.993 0 0112 4a8 8 0 018 8v5a1 1 0 01-1 1h-1a1 1 0 01-1-1v-1a1 1 0 01-1-1v-1a1 1 0 01-1-1V9a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H6a1 1 0 01-1-1v-1a1 1 0 01-1-1v-1a1 1 0 01-1-1V5a1 1 0 011-1h2a1 1 0 011 .804z"></path></svg>
                    Modul Literasi (PDF)
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($modules as $module)
                    <a href="{{ $module->getFileUrl() }}" target="_blank" class="flex items-center p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="font-bold text-slate-800 truncate">{{ $module->title }}</h4>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-tighter">{{ $module->file_type }} • {{ $module->getFormattedFileSize() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>