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
            <form action="{{ route('videos.update', $video) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf @method('PATCH')
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        <div>
                            <x-input-label for="title" :value="__('Judul Video')" class="font-bold" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('title', $video->title)" required />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Lengkap')" class="font-bold" />
                            <textarea id="description" name="description" rows="10" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-red-500 rounded-2xl">{{ old('description', $video->description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="tags" :value="__('Hashtags')" class="font-bold" />
                            <x-text-input id="tags" name="tags" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('tags', $video->tags)" />
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        <div class="aspect-video rounded-xl overflow-hidden shadow-inner bg-gray-100 border border-gray-200 mb-4">
                            <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg" class="w-full h-full object-cover">
                        </div>

                        <div>
                            <x-input-label for="topic_id" :value="__('Topik')" class="font-bold" />
                            <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl transition">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $video->topic_id == $topic->id ? 'selected' : '' }}>
                                        [{{ $topic->category->name }}] {{ $topic->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="youtube_id" :value="__('ID YouTube')" class="font-bold" />
                            <x-text-input id="youtube_id" name="youtube_id" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl font-mono" :value="old('youtube_id', $video->youtube_id)" required />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="duration" :value="__('Detik')" class="font-bold" />
                                <x-text-input id="duration" name="duration" type="number" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('duration', $video->duration)" required />
                            </div>
                            <div>
                                <x-input-label for="level" :value="__('Level')" class="font-bold" />
                                <select name="level" id="level" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl">
                                    <option value="pemula" {{ $video->level == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                    <option value="menengah" {{ $video->level == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                    <option value="lanjut" {{ $video->level == 'lanjut' ? 'selected' : '' }}>Lanjut</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-50">
                            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 py-4 rounded-xl shadow-lg border-none transition font-black text-sm tracking-widest uppercase">
                                Update Data
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>