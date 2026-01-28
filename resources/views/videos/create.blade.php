<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('videos.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Publish Video Edukasi</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 leading-relaxed">
            <form action="{{ route('videos.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        <div>
                            <x-input-label for="title" :value="__('Judul Video (YouTube Style)')" class="font-bold" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-red-500 rounded-xl" placeholder="Ketik judul yang menarik..." required />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Lengkap')" class="font-bold" />
                            <textarea id="description" name="description" rows="10" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-red-500 rounded-2xl" placeholder="Ceritakan isi materi video ini..."></textarea>
                        </div>

                        <div>
                            <x-input-label for="tags" :value="__('Hashtags (Pisahkan dengan koma)')" class="font-bold" />
                            <x-text-input id="tags" name="tags" type="text" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-red-500 rounded-xl" placeholder="#siagabencana, #gempa, #edukasi" />
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                        <div>
                            <x-input-label for="topic_id" :value="__('Topik & Kategori')" class="font-bold" />
                            <select name="topic_id" id="topic_id" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl transition">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}">[{{ $topic->category->name }}] {{ $topic->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="youtube_id" :value="__('ID Video YouTube')" class="font-bold" />
                            <x-text-input id="youtube_id" name="youtube_id" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl font-mono" placeholder="Contoh: dQw4w9WgXcQ" required />
                            <p class="mt-2 text-[10px] text-gray-400">ID ada di ujung URL YouTube setelah ?v=</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="duration" :value="__('Durasi (Detik)')" class="font-bold" />
                                <x-text-input id="duration" name="duration" type="number" class="block mt-1 w-full bg-gray-50 rounded-xl" placeholder="360" required />
                            </div>
                            <div>
                                <x-input-label for="level" :value="__('Level')" class="font-bold" />
                                <select name="level" id="level" class="block mt-1 w-full border-gray-200 bg-gray-50 rounded-xl">
                                    <option value="pemula">Pemula</option>
                                    <option value="menengah">Menengah</option>
                                    <option value="lanjut">Lanjut</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-50">
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 py-4 rounded-xl shadow-lg shadow-red-100 border-none transition font-black text-sm tracking-widest uppercase">
                                Publish Video
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>