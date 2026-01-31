<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SiagaBencana Aceh') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="flex min-h-screen overflow-hidden">
            <aside class="w-64 bg-slate-900 text-white flex-shrink-0 sticky top-0 h-screen overflow-y-auto z-20 shadow-xl">
                @include('layouts.navigation')
            </aside>

            <div class="flex-1 flex flex-col h-screen overflow-y-auto overflow-x-hidden">
                @isset($header)
                    <header class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            <div class="text-sm font-medium text-slate-500 uppercase tracking-wider">
                                {{ __('Admin Panel') }}
                            </div>
                            <div class="flex items-center space-x-4">
                                {{ $header }}
                            </div>
                        </div>
                    </header>
                @endisset

                <main class="p-6 lg:p-10">
                    <div class="mb-8">
                        <h1 class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">Project Platform</h1>
                        <p class="text-lg font-semibold text-slate-800 leading-tight">
                            Pengembangan Platform Literasi Digital Berbasis Budaya Lokal untuk Mitigasi Bencana Banjir di Aceh
                        </p>
                    </div>

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>