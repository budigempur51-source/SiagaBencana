<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Note: Tombol Tambah Kategori DIHAPUS sesuai instruksi --}}
                    <div class="mb-4 text-sm text-gray-500">
                        <span class="font-bold">Catatan:</span> Kategori dikunci (Anak-anak, UMKM, Kesehatan). Anda hanya dapat mengedit detailnya.
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b text-left">Nama Kategori</th>
                                    <th class="py-2 px-4 border-b text-left">Slug</th>
                                    <th class="py-2 px-4 border-b text-left">Deskripsi</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b font-medium">{{ $category->name }}</td>
                                        <td class="py-2 px-4 border-b text-gray-500">{{ $category->slug }}</td>
                                        <td class="py-2 px-4 border-b">{{ Str::limit($category->description, 50) }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 font-semibold mx-2">
                                                Edit
                                            </a>
                                            
                                            {{-- Tombol Delete DIHAPUS --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>