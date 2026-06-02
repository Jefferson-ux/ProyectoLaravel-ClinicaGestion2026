<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" >
            <div>
                <a href="/" class="flex items-center gap-2 group" wire:navigate>
                    <img width="150" height="150" src="https://png.pngtree.com/png-clipart/20230307/original/pngtree-medical-logo-vector-png-image_8975261.png" alt="Logo MedaCare">
                    <span class="font-semibold text-base sm:text-2xl text-clinic-ink leading-tight hidden sm:inline">
                        Clínica <span class="text-clinic-purple-dark font-bold text-4xl">MedaCare</span>
                    </span>
                </a>
            </div>

<!-- Contenedor Padre: Maneja la animación de pulso del aura exterior y el sombreado amplio -->
<div class="relative w-full sm:max-w-md mt-6 rounded-2xl p-[2px] overflow-hidden shadow-[0_20px_50px_rgba(6,182,212,0.15)] animate-pulse-subtle">

    <!-- Capa del Gradiente Animado: Gira de fondo simulando un flujo de energía cian/azul -->
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 animate-gradient-x opacity-75 blur-[1px]"></div>

    <!-- El Contenedor Real (Encapsula el Slot): Fondo blanco limpio con bordes redondeados perfectos -->
    <div class="relative w-full bg-white px-8 py-6 rounded-[14px] transition-all duration-300 hover:scale-[1.01] hover:shadow-[0_25px_60px_rgba(59,130,246,0.25)]">

        <!-- Línea sutil de acento interno estilo "Cian Quirúrgico" -->
        <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-cyan-400 to-blue-500"></div>

        {{ $slot }}
    </div>
</div>
        </div>
    </body>
</html>
