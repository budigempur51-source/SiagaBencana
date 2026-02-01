<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Video Edukasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- DEBUGGING: TAMPILKAN SEMUA ERROR DISINI --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Gagal Menyimpan!</strong>
                    <span class="block sm:inline">Silakan perbaiki error berikut:</span>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <div class="p-8">
                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" x-data="{ uploadType: 'youtube' }">
                        @csrf
                        
                        {{-- Hidden Input untuk Durasi Otomatis --}}
                        <input type="hidden" name="duration" id="duration_input" value="0">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="topic_id" :value="__('Bagian / Kategori Konten')" />
                                    <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
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
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" placeholder="Contoh: Cara Evakuasi Banjir" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="level" :value="__('Tingkat Kesulitan')" />
                                    <select name="level" id="level" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
                                        <option value="pemula" {{ old('level') == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                        <option value="menengah" {{ old('level') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                        <option value="lanjut" {{ old('level') == 'lanjut' ? 'selected' : '' }}>Lanjut</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('level')" class="mt-2" />
                                </div>

                                {{-- FITUR SHORTS CHECKBOX --}}
                                <div class="p-4 bg-purple-50 rounded-lg border border-purple-100 mt-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_short" value="1" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" {{ old('is_short') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm font-bold text-gray-700">Ini adalah Video Shorts (Vertikal)</span>
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1 ml-6">Centang jika video berformat portrait (9:16) atau durasi dibawah 60 detik.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <x-input-label :value="__('Sumber Video')" class="font-bold text-gray-700" />
                                    <x-input-error :messages="$errors->get('video_type')" class="mt-2 mb-2" />
                                    
                                    <div class="flex space-x-4 mt-2 mb-4">
                                        <label class="inline-flex items-center text-sm cursor-pointer">
                                            <input type="radio" name="video_type" value="youtube" x-model="uploadType" class="text-blue-600 focus:ring-blue-500" {{ old('video_type', 'youtube') == 'youtube' ? 'checked' : '' }}>
                                            <span class="ml-2">YouTube ID</span>
                                        </label>
                                        <label class="inline-flex items-center text-sm cursor-pointer">
                                            <input type="radio" name="video_type" value="upload" x-model="uploadType" class="text-blue-600 focus:ring-blue-500" {{ old('video_type') == 'upload' ? 'checked' : '' }}>
                                            <span class="ml-2">Upload File (Max 1GB)</span>
                                        </label>
                                    </div>

                                    <div x-show="uploadType === 'youtube'">
                                        <x-input-label for="youtube_id" :value="__('YouTube Video ID')" />
                                        <x-text-input id="youtube_id" name="youtube_id" type="text" class="mt-1 block w-full font-mono" placeholder="Contoh: dQw4w9WgXcQ" :value="old('youtube_id')" />
                                        <x-input-error :messages="$errors->get('youtube_id')" class="mt-2" />
                                    </div>

                                    <div x-show="uploadType === 'upload'" style="display:none;">
                                        <x-input-label for="video_file" :value="__('Pilih File Video')" />
                                        <input type="file" name="video_file" id="video_file" onchange="getVideoDuration(this)" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                        <p class="text-[10px] text-red-500 mt-1 font-medium">* Pastikan PHP config upload_max_filesize cukup besar.</p>
                                        <p id="duration_info" class="text-[10px] text-emerald-600 mt-1 font-bold" style="display:none;">Durasi terdeteksi: <span id="duration_display">0</span> detik</p>
                                        <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="thumbnail" :value="__('Thumbnail Kustom (Opsional)')" />
                                    <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700" />
                                    <p class="text-[10px] text-gray-400 mt-1">Jika kosong & sumber YouTube, thumbnail akan diambil otomatis.</p>
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-input-label for="description" :value="__('Deskripsi Lengkap')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" placeholder="Jelaskan detail materi..." required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
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

    {{-- Script Auto Detect Duration --}}
    <script>
        function getVideoDuration(input) {
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var video = document.createElement('video');
                video.preload = 'metadata';
                
                video.onloadedmetadata = function() {
                    window.URL.revokeObjectURL(video.src);
                    var duration = Math.round(video.duration);
                    
                    // Set hidden input
                    document.getElementById('duration_input').value = duration;
                    
                    // Show info to user
                    document.getElementById('duration_display').innerText = duration;
                    document.getElementById('duration_info').style.display = 'block';
                }
                
                video.src = URL.createObjectURL(file);
            }
        }
    </script>
</x-app-layout>