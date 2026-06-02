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
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.tailwindcss.css">

        <link rel="stylesheet" href="{{ asset('css/custom-datatables.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Ejemplos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/1.0.3/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bulma.css">

        {{-- Estilos oficiales para los Botones --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css">


{{-- COLVIS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap5.css">

        @stack('styles')
    </head>
    <body class="font-sans antialiased text-clinic-ink">
        <div class="clinic-app-shell min-h-screen">
            <livewire:layout.navigation />

            {{-- Contenido principal desplazado por sidebar (lg) y topbar --}}
            <div class="lg:pl-64 pt-16 min-h-screen flex flex-col">
                @if (isset($header))
                    <header class="clinic-page-header">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 text-clinic-navy">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1 clinic-main-content">
                    {{ $slot }}
                </main>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.8/js/dataTables.tailwindcss.js"></script>

        <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>

        <script>
function initDataTable() {
    const table = document.getElementById('tabla-clinica');

    if (!table || typeof DataTable === 'undefined' || $.fn.DataTable.isDataTable('#tabla-clinica')) {
        return;
    }

    new DataTable('#tabla-clinica', {
        theme: 'tailwindcss',

        layout: {
            top2Start: {
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa-solid fa-copy mr-2"></i> Copiar',
                        className: 'btn-dt-custom btn-dt-copy'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa-solid fa-file-excel mr-2"></i> Excel',
                        className: 'btn-dt-custom btn-dt-excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa-solid fa-file-pdf mr-2"></i> PDF',
                        className: 'btn-dt-custom btn-dt-pdf',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa-solid fa-print mr-2"></i> Imprimir',
                        className: 'btn-dt-custom btn-dt-print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        customize: function (win) {
                            const sheet = win.document.createElement('style');
                            sheet.innerHTML = "@page { size: landscape; margin: 10mm; }";
                            win.document.head.appendChild(sheet);

                            $(win.document.body).css('background', '#ffffff').css('color', '#000000').css('font-size', '12px');

                            $(win.document.body).prepend(`
                                <div style="text-align: center; margin-bottom: 25px; font-family: sans-serif; border-bottom: 2px solid #06b6d4; padding-bottom: 12px;">
                                    <h1 style="margin: 0; color: #1a1a1e; font-size: 24px; font-weight: bold; letter-spacing: 0.5px;">MEDACARE — CONTROL INTERNO</h1>
                                    <p style="margin: 4px 0 0 0; color: #4b5563; font-size: 13px;">Chimbote, Perú // Reporte Oficial de Auditoría Integrado</p>
                                    <p style="margin: 3px 0 0 0; color: #9ca3af; font-size: 10px; font-family: monospace;">Impreso el: ${new Date().toLocaleDateString()} a las ${new Date().toLocaleTimeString()}</p>
                                </div>
                            `);

                            const $table = $(win.document.body).find('table');
                            $table.css({ 'border-collapse': 'collapse', 'width': '100%', 'margin-top': '10px' });
                            $table.find('thead th').css({ 'background-color': '#f8fafc', 'color': '#0e7490', 'font-weight': 'bold', 'border': '1px solid #cbd5e1', 'padding': '10px', 'text-align': 'left' });
                            $table.find('tbody td').css({ 'border': '1px solid #e2e8f0', 'padding': '8px' });

                            $table.find('tr').each(function() {
                                $(this).find('td:last, th:last').remove();
                            });

                            $(win.document.body).append(`
                                <div style="text-align: right; margin-top: 40px; font-family: sans-serif; font-size: 11px; color: #6b7280; border-top: 1px dashed #cbd5e1; padding-top: 12px;">
                                    Reporte de Sistema de Ingeniería // Firma Autorizada: ___________________________
                                </div>
                            `);
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa-solid fa-eye mr-2"></i> Columnas',
                        className: 'btn-dt-custom btn-dt-colvis'
                    }
                ]
            },
            topEnd: null,
            topStart: 'pageLength',
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging',
        },

        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
        autoWidth: false,
        width: '100%',
        order: [[0, 'asc']],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/es-ES.json',
            paginate: {
                first: '<<',
                previous: '<',
                next: '>',
                last: '>>'
            }
        },
    });
}

document.addEventListener('DOMContentLoaded', initDataTable);
document.addEventListener('livewire:navigated', initDataTable);
</script>

        @stack('scripts')

        <style>
            /* Contenedor de botones (Alineación y separación) */
            .dt-buttons {
                display: inline-flex !important;
                gap: 0.5rem !important;
                margin-bottom: 1.25rem !important;
            }

            /* Estilo Estándar Base para todos los botones personalizados */
            .btn-dt-custom {
                padding: 0.4rem 0.85rem !important;
                font-size: 0.875rem !important;
                font-weight: 500 !important;
                font-family: inherit !important;
                border-radius: 0.5rem !important; /* ¡Por fin el rounded-lg forzado! */
                cursor: pointer !important;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                transition: all 0.2s ease-in-out !important;
            }

            /* 1. Botón Copiar (Gris/Slate Clínico) */
            .btn-dt-copy {
                background-color: #f8fafc !important;
                border: 1px solid #e2e8f0 !important;
                color: #334155 !important;
            }
            .btn-dt-copy:hover {
                background-color: #f1f5f9 !important;
                border-color: #cbd5e1 !important;
            }

            /* 2. Botón Excel (Verde Hojas de Cálculo) */
            .btn-dt-excel {
                background-color: #ecfdf5 !important;
                border: 1px solid #a7f3d0 !important;
                color: #047857 !important;
            }
            .btn-dt-excel:hover {
                background-color: #059669 !important;
                border-color: #059669 !important;
                color: #ffffff !important;
            }

            /* 3. Botón PDF (Rojo Documental Corporativo) */
            .btn-dt-pdf {
                background-color: #fff1f2 !important;
                border: 1px solid #fecdd3 !important;
                color: #be123c !important;
            }
            .btn-dt-pdf:hover {
                background-color: #e11d48 !important;
                border-color: #e11d48 !important;
                color: #ffffff !important;
            }

            /* 4. Botón Imprimir (Cian/Azul Quirúrgico) */
            .btn-dt-print {
                background-color: #ecfeff !important;
                border: 1px solid #a5f3fc !important;
                color: #0e7490 !important;
            }
            .btn-dt-print:hover {
                background-color: #0891b2 !important;
                border-color: #0891b2 !important;
                color: #ffffff !important;
            }
            /* 5. Botón Visibilidad de Columnas (Soft Índigo) */
            .btn-dt-colvis {
                background-color: #e0e7ff !important;
                border: 1px solid #c7d2fe !important;
                color: #4338ca !important;
            }
            .btn-dt-colvis:hover {
                background-color: #4f46e5 !important;
                border-color: #4f46e5 !important;
                color: #ffffff !important;
            }
        </style>
    </body>
</html>
