<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-300 mb-1 ml-1">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <input id="name" class="glass-input block w-full pl-10 pr-3 py-2.5 rounded-xl text-sm placeholder-slate-500 focus:ring-0" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300 mb-1 ml-1">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                </div>
                <input id="email" class="glass-input block w-full pl-10 pr-3 py-2.5 rounded-xl text-sm placeholder-slate-500 focus:ring-0" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-300 mb-1 ml-1">Password</label>
            <div class="relative" x-data="{ show: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="password" class="glass-input block w-full pl-10 pr-10 py-2.5 rounded-xl text-sm placeholder-slate-500 focus:ring-0" 
                       :type="show ? 'text' : 'password'" 
                       name="password" required autocomplete="new-password" placeholder="Min. 8 karakter" />
                 <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1 ml-1">Konfirmasi Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <input id="password_confirmation" class="glass-input block w-full pl-10 pr-3 py-2.5 rounded-xl text-sm placeholder-slate-500 focus:ring-0" 
                        type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-slate-400 hover:text-white transition" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-blue-500 hover:to-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition ease-in-out duration-300 transform hover:scale-[1.02] shadow-lg shadow-blue-600/30">
                Daftar
            </button>
        </div>
        
        <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-[#121b33] bg-opacity-0 text-slate-500 backdrop-blur-sm">Atau daftar dengan</span>
            </div>
        </div>

         <div class="grid grid-cols-2 gap-4 mt-6">
            <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center px-4 py-2.5 border border-slate-600 rounded-xl bg-slate-800/50 hover:bg-slate-700/50 hover:border-slate-500 transition duration-300 group">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-2" alt="Google">
                <span class="text-sm font-medium text-slate-300 group-hover:text-white">Google</span>
            </a>
            <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center px-4 py-2.5 border border-slate-600 rounded-xl bg-slate-800/50 hover:bg-slate-700/50 hover:border-slate-500 transition duration-300 group">
                <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-5 w-5 mr-2" alt="Facebook">
                <span class="text-sm font-medium text-slate-300 group-hover:text-white">Facebook</span>
            </a>
        </div>
    </form>
</x-guest-layout>