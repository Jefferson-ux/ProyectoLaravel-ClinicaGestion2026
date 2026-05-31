<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
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

        {{-- Base DataTables 2 (sin integración Tailwind; los estilos se personalizan en public/css/custom-datatables.css) --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="{{ asset('css/custom-datatables.css') }}">


        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.tailwindcss.js"></script>

        <script>
    // 1. Creamos una función reutilizable para inicializar la tabla
    function initDataTable() {
        const table = document.getElementById('tabla-clinica');

        // Si la tabla no existe en esta página o DataTables ya está activo, no hacemos nada
        if (!table || typeof DataTable === 'undefined' || $.fn.DataTable.isDataTable('#tabla-clinica')) {
            return;
        }

        new DataTable('#tabla-clinica', {
            layout: {
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging',
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
            autoWidth: false,
            width: '100%',
            order: [[0, 'asc']],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/es-ES.json', // Español
            },
        });
    }

    // 2. Ejecutar cuando la página carga por primera vez (F5)
    document.addEventListener('DOMContentLoaded', initDataTable);

    // 3. Ejecutar CADA VEZ que Livewire cambia de página sin recargar
    document.addEventListener('livewire:navigated', initDataTable);
</script>

        @stack('scripts')
    </body>
</html>
