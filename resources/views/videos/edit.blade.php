<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('videos.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Video</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 leading-relaxed">
            <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf @method('PATCH')
                
                {{-- Hidden Duration --}}
                <input type="hidden" name="duration" id="duration_input" value="{{ $video->duration }}">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        <div>
                            <x-input-label for="title" :value="__('Judul Video')" class="font-bold" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('title', $video->title)" required />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Lengkap')" class="font-bold" />
                            <textarea id="description" name="description" rows="10" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-blue-500 rounded-2xl">{{ old('description', $video->description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="tags" :value="__('Hashtags')" class="font-bold" />
                            <x-text-input id="tags" name="tags" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('tags', $video->tags)" />
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        
                        {{-- Preview Logic --}}
                        <div class="aspect-video rounded-xl overflow-hidden shadow-inner bg-gray-100 border border-gray-200 mb-4 relative">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover">
                            @elseif($video->youtube_id)
                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">No Preview</div>
                            @endif
                        </div>

                        {{-- SHORTS TOGGLE --}}
                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-xl border border-purple-100">
                            <span class="text-sm font-bold text-purple-700">Video Shorts?</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_short" value="1" class="sr-only peer" {{ $video->is_short ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                            </label>
                        </div>

                        <div>
                            <x-input-label for="topic_id" :value="__('Topik')" class="font-bold" />
                            <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl transition">
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->name }}">
                                        @foreach($category->topics as $topic)
                                            <option value="{{ $topic->id }}" {{ $video->topic_id == $topic->id ? 'selected' : '' }}>
                                                {{ $topic->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                             <x-input-label for="level" :value="__('Level')" class="font-bold" />
                             <select name="level" id="level" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl">
                                 <option value="pemula" {{ $video->level == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                 <option value="menengah" {{ $video->level == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                 <option value="lanjut" {{ $video->level == 'lanjut' ? 'selected' : '' }}>Lanjut</option>
                             </select>
                         </div>

                        {{-- Upload Ulang Thumbnail --}}
                        <div>
                             <x-input-label for="thumbnail" :value="__('Ganti Thumbnail')" class="font-bold" />
                             <input type="file" name="thumbnail" class="mt-1 block w-full text-sm text-gray-500">
                        </div>

                        {{-- Upload Ulang Video --}}
                        <div>
                            <x-input-label for="video_file" :value="__('Ganti File Video')" class="font-bold" />
                            <input type="file" name="video_file" onchange="getVideoDuration(this)" class="mt-1 block w-full text-sm text-gray-500">
                            <p id="duration_info" class="text-[10px] text-emerald-600 mt-1 font-bold" style="display:none;">Durasi baru: <span id="duration_display">0</span> detik</p>
                        </div>

                        <div class="pt-6 border-t border-gray-50">
                            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 py-4 rounded-xl shadow-lg border-none transition font-black text-sm tracking-widest uppercase">
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
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
                    document.getElementById('duration_input').value = duration;
                    document.getElementById('duration_display').innerText = duration;
                    document.getElementById('duration_info').style.display = 'block';
                }
                video.src = URL.createObjectURL(file);
            }
        }
    </script>
</x-app-layout>