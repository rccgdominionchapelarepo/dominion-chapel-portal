<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'The Light House') }}</title>

    <!-- Official Brand Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300..900&family=Work+Sans:wght@300..700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Work Sans', sans-serif; 
            background-color: #050A15; 
        }
        .font-fraunces { font-family: 'Fraunces', serif; }
        .font-mono-brand { font-family: 'JetBrains Mono', monospace; }
        
        /* Bulletproof Background Fix */
        .ambient-bg {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 0;
            background-image: url('{{ asset('images/church-logo.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            filter: blur(60px);
            opacity: 0.3;
            transform: scale(1.1);
        }
        .ambient-overlay {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 1;
            background-color: rgba(5, 10, 21, 0.85); /* Deep Navy Overlay */
        }
    </style>
</head>
<body class="antialiased text-gray-200 min-h-screen relative overflow-x-hidden">

    <!-- 1. The Fixed Background -->
    <div class="ambient-bg"></div>
    <div class="ambient-overlay"></div>

    <!-- 2. The Main Foreground Content -->
    <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        
        <div class="mb-8 mt-12 sm:mt-0 br-5">
            <a href="/" class="flex justify-center group">
                <img src="{{ asset('images/church-logo.png') }}" alt="The Light House Logo" class="h-20 w-auto object-contain drop-shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-transform duration-300 hover:scale-105 br-5">
            </a>
        </div>

        <!-- The Glass/Navy Auth Card -->
        <div class="w-full sm:max-w-md px-8 py-10 bg-[#091124]/90 backdrop-blur-2xl border border-[#1A243D] shadow-[0_8px_32px_rgba(0,0,0,0.6)] sm:rounded-2xl relative overflow-hidden">
            {{ $slot }}
        </div>
    </div>

</body>
</html>