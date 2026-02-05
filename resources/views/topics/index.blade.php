<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-800">Topik Edukasi</h2>
                    <p class="text-slate-500 text-sm">Manajemen sub-materi pembelajaran bencana.</p>
                </div>

                {{-- Tombol Tambah --}}
                <a href="{{ route('topics.create') }}" class="px-6 py-3 bg-purple-600 text-white font-bold rounded-full shadow-lg hover:bg-purple-700 hover:shadow-purple-500/30 transition transform active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Topik
                </a>
            </div>
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- TABEL DATA --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-[25px] border border-slate-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-400 uppercase tracking-widest">Visual</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-400 uppercase tracking-widest">Judul Topik</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-400 uppercase tracking-widest">Kategori Induk</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($topics as $topic)
                                <tr class="hover:bg-slate-50/50 transition duration-150 group">
                                    
                                    {{-- Kolom Gambar (FIX: Ada Tulisannya Sekarang) --}}
                                    <td class="px-8 py-4 w-32">
                                        <div class="w-24 h-16 rounded-xl overflow-hidden shadow-sm relative">
                                            @if($topic->thumbnail)
                                                <img src="{{ asset('storage/' . $topic->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                            @else
                                                {{-- Placeholder Gradient Purple + TEXT --}}
                                                <div class="w-full h-full bg-gradient-to-br from-purple-500 to-indigo-600 flex flex-col items-center justify-center group-hover:scale-110 transition duration-500 p-1">
                                                    <svg class="w-5 h-5 text-white/60 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    {{-- INI TULISANNYA BRO --}}
                                                    <span class="text-[8px] font-black text-white/80 uppercase tracking-widest">No Cover</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kolom Judul --}}
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-slate-700 block text-lg group-hover:text-purple-600 transition">{{ $topic->title }}</span>
                                        <code class="text-[10px] text-slate-400 bg-slate-100 px-2 py-0.5 rounded font-mono">/{{ $topic->slug }}</code>
                                    </td>

                                    {{-- Kolom Kategori --}}
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border" 
                                              style="background-color: {{ $topic->category->color }}10; color: {{ $topic->category->color }}; border-color: {{ $topic->category->color }}30;">
                                            {{ $topic->category->name }}
                                        </span>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('topics.edit', $topic) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-purple-600 rounded-full hover:bg-purple-50 transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('topics.destroy', $topic) }}" method="POST" onsubmit="return confirm('Yakin hapus topik ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-slate-50 text-slate-400 hover:text-red-600 rounded-full hover:bg-red-50 transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
                                            </div>
                                            <h3 class="text-slate-800 font-bold">Belum ada topik</h3>
                                            <p class="text-slate-400 text-sm mt-1">Silakan tambahkan topik baru untuk memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>