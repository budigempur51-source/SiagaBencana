<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold mb-4">Edit Modul: {{ $module->title }}</h2>

                    <form action="{{ route('modules.update', $module) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="topic_id" :value="__('Topik Bahasan')" />
                            <select id="topic_id" name="topic_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $module->topic_id == $topic->id ? 'selected' : '' }}>
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

                        <div class="mb-4">
                            <x-input-label for="cover_image" :value="__('Ganti Sampul (Opsional)')" />
                            
                            @if($module->cover_image)
                                <div class="mb-2">
                                    <p class="text-xs text-gray-500 mb-1">Sampul Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $module->cover_image) }}" alt="Cover" class="w-32 h-auto rounded shadow-sm border">
                                </div>
                            @endif

                            <input id="cover_image" type="file" name="cover_image" accept="image/*"
                                class="block mt-1 w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" />
                            <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah sampul.</p>
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="file" :value="__('Ganti File PDF (Opsional)')" />
                            
                            <div class="text-sm text-gray-600 mb-2 bg-gray-50 p-2 rounded">
                                File saat ini: <a href="{{ asset('storage/' . $module->file_path) }}" target="_blank" class="text-blue-600 hover:underline font-medium">Lihat PDF</a>
                            </div>

                            <input id="file" type="file" name="file" accept=".pdf" class="block mt-1 w-full border border-gray-300 rounded p-1" />
                            <p class="mt-1 text-sm text-gray-500">Upload hanya jika ingin mengganti file dokumen.</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $module->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="block mt-4 mb-4">
                            <label for="is_featured" class="inline-flex items-center">
                                <input id="is_featured" type="checkbox" name="is_featured" value="1" {{ $module->is_featured ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Tampilkan di Highlight Dashboard?') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('modules.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Perbarui Modul') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>