<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dominion Chapel Admin') }}</title>

        <!-- Official Brand Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300..900&family=Work+Sans:wght@300..700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Work Sans', sans-serif; }
            .font-fraunces { font-family: 'Fraunces', serif; }
            .font-mono-brand { font-family: 'JetBrains Mono', monospace; }
        </style>
        <!-- PWA Configuration -->
        <meta name="theme-color" content="#050A15"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="{{ asset('icons/icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <!-- Service Worker Registration -->
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js').then(function(registration) {
                        console.log('PWA ServiceWorker registered successfully');
                    }).catch(function(err) {
                        console.log('PWA ServiceWorker registration failed: ', err);
                    });
                });
            }
        </script>
    </head>
    <!-- Deep Navy Background -->
    <body class="font-sans antialiased bg-[#050A15] text-gray-200">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-[#091124] border-b border-[#1A243D] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>