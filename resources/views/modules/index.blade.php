<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Modul Pembelajaran') }}
            </h2>
            <a href="{{ route('modules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Tambah Modul
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-gray-100">
                                    <th class="px-4 py-3 text-sm font-bold text-gray-600 uppercase">Modul</th>
                                    <th class="px-4 py-3 text-sm font-bold text-gray-600 uppercase">Topik & Kategori</th>
                                    <th class="px-4 py-3 text-sm font-bold text-gray-600 uppercase">Info File</th>
                                    <th class="px-4 py-3 text-sm font-bold text-gray-600 uppercase">Status</th>
                                    <th class="px-4 py-3 text-sm font-bold text-gray-600 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($modules as $module)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                        <td class="px-4 py-4">
                                            <div class="font-bold text-gray-800">{{ $module->title }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($module->summary, 60) }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium text-blue-600">{{ $module->topic->title }}</span>
                                            <div class="text-xs text-gray-400 italic">{{ $module->topic->category->name }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-bold uppercase">{{ $module->file_type }}</span>
                                            <span class="text-xs text-gray-500 ml-1">{{ $module->getFormattedFileSize() }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($module->is_featured)
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Featured</span>
                                            @else
                                                <span class="text-gray-300 text-xs">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ $module->getFileUrl() }}" target="_blank" class="text-blue-500 hover:text-blue-700" title="Lihat File">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </a>
                                                <a href="{{ route('modules.edit', $module) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </a>
                                                <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-10 text-center text-gray-400 italic">Belum ada modul yang diunggah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>