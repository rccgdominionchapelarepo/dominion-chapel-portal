<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dominion Chapel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bulletproof Custom Styles -->
        <style>
            .auth-bg-blur {
                position: absolute;
                inset: 0;
                background-size: cover;
                background-position: center;
                filter: blur(12px);          /* Forces the blur effect */
                transform: scale(1.1);       /* Hides the blurred white edges off-screen */
                z-index: 0;
            }
            .auth-dark-overlay {
                position: absolute;
                inset: 0;
                background-color: rgba(5, 10, 21, 0.85); /* Deep navy tint */
                z-index: 1;
            }
            .auth-glass-card {
                position: relative;
                z-index: 10;
                background-color: rgba(9, 17, 36, 0.65); /* Semi-transparent navy */
                backdrop-filter: blur(20px);             /* Frosted glass effect */
                -webkit-backdrop-filter: blur(20px);     /* Safari support */
                border: 1px solid rgba(212, 175, 55, 0.2); /* Subtle gold border */
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
            /* Make default Laravel text inputs look better on the dark background */
            .auth-glass-card label {
                color: #D4AF37 !important; /* Gold labels */
                font-weight: bold;
                letter-spacing: 1px;
            }
            .auth-glass-card input {
                background-color: rgba(5, 10, 21, 0.8) !important;
                border: 1px solid #1A243D !important;
                color: white !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <!-- 1. Background Image Wrapper -->
        <div class="fixed inset-0 z-0 overflow-hidden">
            <!-- The Blurred Image -->
            <div class="auth-bg-blur" style="background-image: url('{{ asset('images/Screenshot_20260918-002343.jpg') }}');"></div>
            
            <!-- Dark Navy Overlay -->
            <div class="auth-dark-overlay"></div>
        </div>

        <!-- 2. Content Wrapper -->
        <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <!-- Logo -->
            <div class="mb-6 relative z-10">
                <a href="/">
                    <picture>
                        <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
                        <img src="{{ asset('images/logo.png') }}" alt="RCCG logo" class="h-24 w-auto drop-shadow-2xl">
                    </picture>
                </a>
            </div>

            <!-- 3. The Form Card (Glassmorphism Effect) -->
            <div class="w-full sm:max-w-md px-8 py-10 overflow-hidden sm:rounded-2xl auth-glass-card">
                {{ $slot }}
            </div>
            
        </div>
        
    </body>
</html>