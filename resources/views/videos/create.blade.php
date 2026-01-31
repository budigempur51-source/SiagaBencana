<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Video Edukasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <div class="p-8">
                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" x-data="{ uploadType: 'youtube' }">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="topic_id" :value="__('Bagian / Kategori Konten')" />
                                    <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
                                        <option value="">-- Pilih Penempatan Video --</option>
                                        @foreach($categories as $category)
                                            <optgroup label="KATEGORI: {{ strtoupper($category->name) }}">
                                                @foreach($category->topics as $topic)
                                                    <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                                        {{ $topic->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('topic_id')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="title" :value="__('Judul Video')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" placeholder="Contoh: Cara Evakuasi Banjir untuk Anak" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="level" :value="__('Tingkat Kesulitan')" />
                                    <select name="level" id="level" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
                                        <option value="pemula">Pemula</option>
                                        <option value="menengah">Menengah</option>
                                        <option value="lanjut">Lanjut</option>
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="duration" :value="__('Durasi (Menit)')" />
                                    <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="old('duration', 0)" required />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <x-input-label :value="__('Sumber Video')" />
                                    <div class="flex space-x-4 mt-2">
                                        <label class="inline-flex items-center text-sm">
                                            <input type="radio" name="video_type" value="youtube" x-model="uploadType" class="text-blue-600">
                                            <span class="ml-2">YouTube ID</span>
                                        </label>
                                        <label class="inline-flex items-center text-sm">
                                            <input type="radio" name="video_type" value="upload" x-model="uploadType" class="text-blue-600">
                                            <span class="ml-2">Upload File (Max 1GB)</span>
                                        </label>
                                    </div>

                                    <div class="mt-4">
                                        <div x-show="uploadType === 'youtube'">
                                            <x-input-label for="youtube_id" :value="__('YouTube Video ID')" />
                                            <x-text-input id="youtube_id" name="youtube_id" type="text" class="mt-1 block w-full" placeholder="e.g. dQw4w9WgXcQ" />
                                        </div>

                                        <div x-show="uploadType === 'upload'" style="display:none;">
                                            <x-input-label for="video_file" :value="__('Pilih File Video')" />
                                            <input type="file" name="video_file" id="video_file" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700" />
                                            <p class="text-[10px] text-red-500 mt-1 font-medium italic">* Pastikan setting PHP Anda mengizinkan upload 1GB.</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="thumbnail" :value="__('Thumbnail Kustom (Opsional)')" />
                                    <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full text-sm" />
                                    <p class="text-[10px] text-gray-400 mt-1 italic">Jika kosong, sistem akan mencoba mengambil thumbnail YouTube.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-input-label for="description" :value="__('Deskripsi Lengkap')" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" placeholder="Jelaskan isi materi video ini secara mendalam...">{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-8 flex justify-end items-center space-x-4 border-t pt-6">
                            <a href="{{ route('videos.index') }}" class="text-sm text-gray-500 hover:underline">Batal</a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                {{ __('Publikasikan Video') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>