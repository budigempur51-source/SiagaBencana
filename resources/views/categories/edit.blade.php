<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('categories.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-400 hover:text-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Edit: {{ $category->name }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf @method('PATCH')
                    <div>
                        <x-input-label for="name" :value="__('Nama Kategori')" class="font-bold" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full bg-gray-50 rounded-xl" :value="old('name', $category->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="color" :value="__('Warna')" class="font-bold" />
                        <div class="flex gap-4 mt-1">
                            <input type="color" id="picker" class="h-11 w-20 rounded-lg border-gray-200" value="{{ $category->color }}">
                            <x-text-input id="color" name="color" type="text" class="block w-full bg-gray-50 rounded-xl font-mono" :value="old('color', $category->color)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi')" class="font-bold" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:ring-red-500 rounded-2xl">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-xl shadow-lg shadow-blue-100 border-none">
                            Update Data
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const picker = document.getElementById('picker');
        const input = document.getElementById('color');
        picker.oninput = () => input.value = picker.value.toUpperCase();
        input.oninput = () => picker.value = input.value;
    </script>
</x-app-layout>