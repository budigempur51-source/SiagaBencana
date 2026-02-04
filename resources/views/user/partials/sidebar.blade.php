<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-slate-200 sm:translate-x-0 dark:bg-slate-900 dark:border-slate-800" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-slate-900">
        
        {{-- Category Info --}}
        <div class="flex flex-col items-center mb-8 mt-2 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center text-2xl font-bold text-white mb-3 shadow-lg shadow-blue-500/30">
                {{ substr($category->name, 0, 1) }}
            </div>
            <h5 class="text-base font-bold text-slate-800 text-center leading-tight">{{ $category->name }}</h5>
            <span class="text-xs text-slate-500 mt-1 font-medium">Learning Hub</span>
        </div>

        {{-- Navigation Menu --}}
        <ul class="space-y-2 font-medium">
            {{-- Menu: Video --}}
            <li>
                <a href="{{ route('user.category.videos', $category->slug) }}" 
                   class="flex items-center p-3 rounded-xl group transition-all duration-300 {{ $activeTab === 'video' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-600 hover:bg-slate-100 hover:text-blue-600' }}">
                    <svg class="w-6 h-6 transition duration-75 {{ $activeTab === 'video' ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="ml-3 font-bold">Video Materi</span>
                    @if($activeTab === 'video')
                        <span class="inline-flex items-center justify-center px-2 ml-3 text-xs font-medium text-blue-600 bg-white rounded-full">Active</span>
                    @endif
                </a>
            </li>

            {{-- Menu: Modul --}}
            <li>
                <a href="{{ route('user.category.modules', $category->slug) }}" 
                   class="flex items-center p-3 rounded-xl group transition-all duration-300 {{ $activeTab === 'modul' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-600 hover:bg-slate-100 hover:text-blue-600' }}">
                   <svg class="w-6 h-6 transition duration-75 {{ $activeTab === 'modul' ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                   <span class="ml-3 font-bold">Modul & Buku</span>
                   @if($activeTab === 'modul')
                        <span class="inline-flex items-center justify-center px-2 ml-3 text-xs font-medium text-blue-600 bg-white rounded-full">Active</span>
                    @endif
                </a>
            </li>
        </ul>
        
        <div class="mt-8 pt-8 border-t border-slate-200">
            <a href="{{ route('user.selection') }}" class="flex items-center p-2 text-slate-500 rounded-lg hover:bg-slate-100 hover:text-slate-900 group">
                <svg class="flex-shrink-0 w-5 h-5 text-slate-400 transition duration-75 group-hover:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/></svg>
                <span class="flex-1 ml-3 whitespace-nowrap text-sm font-medium">Ganti Topik</span>
            </a>
        </div>
    </div>
</aside>