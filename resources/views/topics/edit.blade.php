<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('topics.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit Topik</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <form action="{{ route('topics.update', $topic) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PATCH')

                    <div>
                        <x-input-label for="category_id" :value="__('Kategori Induk')" class="font-bold" />
                        <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-200 bg-gray-50 focus:border-red-500 focus:ring-red-500 rounded-xl transition">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $topic->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Judul Topik')" class="font-bold" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('title', $topic->title)" required />
                    </div>

                    <div>
                        <x-input-label :value="__('Thumbnail Saat Ini')" class="font-bold mb-2" />
                        @if($topic->thumbnail)
                            <img src="{{ asset('storage/' . $topic->thumbnail) }}" class="w-40 h-24 object-cover rounded-xl border border-gray-100 shadow-sm mb-4">
                        @endif
                        
                        <x-input-label for="thumbnail" :value="__('Ganti Thumbnail (Opsional)')" class="font-bold" />
                        <input type="file" name="thumbnail" id="thumbnail" class="block mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100" />
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700 px-10 py-3 rounded-xl shadow-lg border-none">
                            {{ __('Update Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>