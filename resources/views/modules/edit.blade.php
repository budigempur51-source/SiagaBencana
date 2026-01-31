<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Modul: ') }} {{ $module->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('modules.update', $module) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-input-label for="topic_id" :value="__('Topik Pembelajaran')" />
                            <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ old('topic_id', $module->topic_id) == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->category->name }} - {{ $topic->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('topic_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Judul Modul')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $module->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4 p-4 bg-gray-50 rounded-md border border-gray-200 text-sm">
                            <div class="font-bold text-gray-700 mb-1 italic">File Saat Ini:</div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="uppercase font-bold mr-2 text-[10px] bg-gray-200 px-1 rounded">{{ $module->file_type }}</span>
                                <a href="{{ $module->getFileUrl() }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a>
                            </div>
                            <hr class="my-3 border-gray-200">
                            <x-input-label for="file" :value="__('Ganti File (Biarkan kosong jika tidak ingin mengubah)')" class="text-xs font-bold text-blue-800" />
                            <input type="file" name="file" id="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-white file:text-gray-700 border border-gray-300 rounded-md" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi / Isi Ringkas')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $module->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label for="is_featured" class="inline-flex items-center">
                                <input id="is_featured" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_featured" value="1" {{ old('is_featured', $module->is_featured) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Tampilkan sebagai Modul Pilihan (Featured)') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('modules.index') }}" class="text-sm text-gray-600 hover:underline mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Update Modul') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>