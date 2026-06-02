<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl leading-tight tracking-wide">
            <i class="fa-solid fa-hospital text-clinic-accent"></i> {{ __('Panel de Control — MedaCare') }}
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="relative overflow-hidden rounded-2xl border border-clinic-turquoise-pastel/60 bg-gradient-to-r from-clinic-cyan-pastel/40 via-white to-clinic-mint/50 p-6 shadow-[var(--shadow-clinic-md)]">
                <div class="relative z-10 max-w-xl">
                    <h3 class="text-2xl font-bold tracking-tight text-clinic-navy sm:text-3xl">
                        Bienvenido de vuelta, <span class="text-clinic-accent">{{ auth()->user()->name ?? 'Administrador' }}</span>
                    </h3>
                    <p class="mt-2 text-sm text-clinic-muted">
                        El sistema médico está operando con normalidad. Aquí tienes el balance general y el estado de la agenda de la clínica para hoy.
                    </p>
                </div>
            </div>

            @php
                $totalPacientes = DB::table('pacientes')->where('estado', 1)->count();
                $totalDoctores = DB::table('doctores')->where('estado', 1)->count();
                $citasPendientes = DB::table('citas')->where('estado', 'PENDIENTE')->count();
                $ingresosCaja = DB::table('pagos')->where('estado', 'PAGADO')->sum('monto');
            @endphp

{{-- Optimización Responsiva Transicional: Móvil (1) → Tablet/Mediano (2) → Desktop (4) --}}
<div class="card-grid">

    <!-- Tarjeta: Pacientes Activos -->
    <div class="clinic-stat-card flex items-center justify-between p-5 bg-white rounded-xl border border-clinic-turquoise-pastel/50 shadow-sm hover:shadow-md transition-all duration-300">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-clinic-muted">Pacientes Activos</p>
            <p class="text-3xl font-bold text-clinic-navy mt-1 font-mono">{{ $totalPacientes }}</p>
        </div>
        <div class="p-3 rounded-lg bg-clinic-cyan-pastel/60 text-clinic-accent border border-clinic-accent/20">
            <i class="fa-solid fa-user-injured text-xl w-6 text-center"></i>
        </div>
    </div>

    <!-- Tarjeta: Staff Médico -->
    <div class="clinic-stat-card flex items-center justify-between p-5 bg-white rounded-xl border border-clinic-turquoise-pastel/50 shadow-sm hover:shadow-md transition-all duration-300">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-clinic-muted">Staff Médico</p>
            <p class="text-3xl font-bold text-clinic-navy mt-1 font-mono">{{ $totalDoctores }}</p>
        </div>
        <div class="p-3 rounded-lg bg-clinic-cyan-pastel/60 text-clinic-accent border border-clinic-accent/20">
            <i class="fa-solid fa-user-md text-xl w-6 text-center"></i>
        </div>
    </div>

    <!-- Tarjeta: Citas Pendientes -->
    <div class="clinic-stat-card flex items-center justify-between p-5 bg-white rounded-xl border border-clinic-turquoise-pastel/50 shadow-sm hover:shadow-md transition-all duration-300">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-clinic-muted">Citas Pendientes</p>
            <p class="text-3xl font-bold text-clinic-navy mt-1 font-mono">{{ $citasPendientes }}</p>
        </div>
        <div class="p-3 rounded-lg bg-amber-100 text-amber-700 border border-amber-300/40">
            <i class="fa-solid fa-calendar-check text-xl w-6 text-center"></i>
        </div>
    </div>

    <!-- Tarjeta: Flujo de Caja Total -->
    <div class="clinic-stat-card flex items-center justify-between p-5 bg-white rounded-xl border border-clinic-turquoise-pastel/50 shadow-sm hover:shadow-md transition-all duration-300">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-clinic-muted">Flujo de Caja Total</p>
            <p class="text-2xl sm:text-3xl font-bold text-emerald-600 mt-1 font-mono">S/. {{ number_format($ingresosCaja, 2) }}</p>
        </div>
        <div class="p-3 rounded-lg bg-emerald-100 text-emerald-700 border border-emerald-300/40">
            <i class="fa-solid fa-wallet text-xl w-6 text-center"></i>
        </div>
    </div>

</div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="clinic-dashboard-panel space-y-4">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-clinic-navy border-b border-clinic-turquoise-pastel/60 pb-2">
                        Accesos Rápidos
                    </h4>
                    <div class="grid grid-cols-1 gap-3">
                        <a href="{{ route('citas.index') }}" class="btn bg-clinic-mint hover:bg-clinic-cyan-pastel text-clinic-navy border border-clinic-turquoise-pastel/50 justify-start gap-3 w-full group">
                            <i class="fa-solid fa-calendar text-clinic-accent group-hover:scale-110 transition-transform"></i>
                            <span>Gestionar Citas Médicas</span>
                        </a>
                        <a href="{{ route('pacientes.index') }}" class="btn bg-clinic-mint hover:bg-clinic-cyan-pastel text-clinic-navy border border-clinic-turquoise-pastel/50 justify-start gap-3 w-full group">
                            <i class="fa-solid fa-users text-clinic-accent group-hover:scale-110 transition-transform"></i>
                            <span>Padrón de Pacientes</span>
                        </a>
                        <a href="{{ url('/citas/recetas') }}" class="btn bg-clinic-mint hover:bg-clinic-cyan-pastel text-clinic-navy border border-clinic-turquoise-pastel/50 justify-start gap-3 w-full group">
                            <i class="fa-solid fa-file-prescription text-clinic-accent group-hover:scale-110 transition-transform"></i>
                            <span>Historial de Recetas</span>
                        </a>
                        <a href="{{ url('/citas/pagos') }}" class="btn bg-clinic-mint hover:bg-clinic-cyan-pastel text-clinic-navy border border-clinic-turquoise-pastel/50 justify-start gap-3 w-full group">
                            <i class="fa-solid fa-file-invoice-dollar text-clinic-accent group-hover:scale-110 transition-transform"></i>
                            <span>Auditoría de Caja (Pagos)</span>
                        </a>
                    </div>
                </div>

                @php
                    $proximasCitas = DB::table('citas')
                        ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id')
                        ->join('doctores', 'citas.id_doctor', '=', 'doctores.id')
                        ->select('citas.*', 'pacientes.nombres as p_nom', 'pacientes.apellidos as p_ape', 'doctores.apellidos as d_ape')
                        ->where('citas.estado', 'PENDIENTE')
                        ->orderBy('citas.fecha', 'asc')
                        ->orderBy('citas.hora', 'asc')
                        ->limit(3)
                        ->get();
                @endphp

                <div class="lg:col-span-2 clinic-dashboard-panel flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-clinic-navy border-b border-clinic-turquoise-pastel/60 pb-2 mb-4">
                            Próximas Consultas en Agenda
                        </h4>

                        <div class="space-y-3">
                            @forelse($proximasCitas as $cita)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-3 bg-clinic-mint/80 rounded-lg border-l-4 border-clinic-accent">
                                    <div class="text-xs">
                                        <p class="font-bold text-clinic-ink text-sm">{{ $cita->p_nom }} {{ $cita->p_ape }}</p>
                                        <p class="text-clinic-muted mt-0.5">Médico: Dr. {{ $cita->d_ape }}</p>
                                    </div>
                                    <div class="text-xs">
                                        <span class="badge bg-clinic-navy text-white font-mono border-0 p-2">
                                            {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m') }} — {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-xs text-clinic-muted italic">
                                    <i class="fa-solid fa-calendar-day text-lg mb-2 block text-clinic-accent/50"></i>
                                    No hay citas pendientes programadas para los próximos días.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="text-right text-[10px] text-clinic-muted font-mono mt-4 pt-2 border-t border-clinic-turquoise-pastel/40">
                        MEDACARE v12.0 // CHIMBOTE, PERÚ
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Estilo Base: Celulares pequeños (1 columna) */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.25rem; /* Equivalente a gap-5 de Tailwind */
        }

        /* Pantallas Medianas (sm): Tablets en adelante (2 columnas) */
        @media (min-width: 530px) {
            .card-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* Pantallas de Escritorio (lg): Laptops y Monitores (4 columnas) */
        @media (min-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }
    </style>
</x-app-layout>
