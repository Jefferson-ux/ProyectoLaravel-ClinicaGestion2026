<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#D4AF37] leading-tight font-sans tracking-wide">
            {{ __('Panel de Control — MedaCare') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#0F0F11] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#1A1A1E] to-[#26262B] p-6 text-white border border-[#3A3A40]/40 shadow-2xl">
                <div class="relative z-10 max-w-xl">
                    <h3 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        Bienvenido de vuelta, <span class="text-[#D4AF37]">{{ auth()->user()->nombres ?? 'Administrador' }}</span>
                    </h3>
                    <p class="mt-2 text-sm text-gray-400">
                        El sistema médico está operando con normalidad. Aquí tienes el balance general y el estado de la agenda de la clínica para hoy.
                    </p>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-[#D4AF37]/5 to-transparent pointer-events-none"></div>
            </div>

            @php
                // Consultas rápidas directo en la vista para evitar configurar controladores extra
                $totalPacientes = DB::table('pacientes')->where('estado', 1)->count();
                $totalDoctores = DB::table('doctores')->where('estado', 1)->count();
                $citasPendientes = DB::table('citas')->where('estado', 'PENDIENTE')->count();
                $ingresosCaja = DB::table('pagos')->where('estado', 'PAGADO')->sum('monto');
            @endphp

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-5 shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Pacientes Activos</p>
                        <p class="text-3xl font-bold text-white mt-1 font-mono">{{ $totalPacientes }}</p>
                    </div>
                    <div class="p-3 bg-[#26262B] text-[#D4AF37] rounded-lg border border-[#D4AF37]/20">
                        <i class="fa-solid fa-user-injured text-xl w-6 text-center"></i>
                    </div>
                </div>

                <div class="bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-5 shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Staff Médico</p>
                        <p class="text-3xl font-bold text-white mt-1 font-mono">{{ $totalDoctores }}</p>
                    </div>
                    <div class="p-3 bg-[#26262B] text-[#D4AF37] rounded-lg border border-[#D4AF37]/20">
                        <i class="fa-solid fa-user-md text-xl w-6 text-center"></i>
                    </div>
                </div>

                <div class="bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-5 shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 font-sans">Citas Pendientes</p>
                        <p class="text-3xl font-bold text-white mt-1 font-mono">{{ $citasPendientes }}</p>
                    </div>
                    <div class="p-3 bg-[#26262B] text-amber-500 rounded-lg border border-amber-500/20">
                        <i class="fa-solid fa-calendar-check text-xl w-6 text-center"></i>
                    </div>
                </div>

                <div class="bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-5 shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Flujo de Caja Total</p>
                        <p class="text-3xl font-bold text-emerald-400 mt-1 font-mono">S/. {{ number_format($ingresosCaja, 2) }}</p>
                    </div>
                    <div class="p-3 bg-[#26262B] text-emerald-400 rounded-lg border border-emerald-400/20">
                        <i class="fa-solid fa-wallet text-xl w-6 text-center"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-6 shadow-xl space-y-4">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#D4AF37] border-b border-[#3A3A40]/60 pb-2">
                        Accesos Rápidos
                    </h4>
                    <div class="grid grid-cols-1 gap-3">
                        <a href="{{ route('citas.index') }}" class="btn bg-[#26262B] hover:bg-[#323239] text-white border-none justify-start gap-3 w-full group">
                            <i class="fa-solid fa-calendar text-[#D4AF37] group-hover:scale-110 transition-transform"></i>
                            <span>Gestionar Citas Médicas</span>
                        </a>
                        <a href="{{ route('pacientes.index') }}" class="btn bg-[#26262B] hover:bg-[#323239] text-white border-none justify-start gap-3 w-full group">
                            <i class="fa-solid fa-users text-[#D4AF37] group-hover:scale-110 transition-transform"></i>
                            <span>Padrón de Pacientes</span>
                        </a>
                        <a href="{{ url('/citas/recetas') }}" class="btn bg-[#26262B] hover:bg-[#323239] text-white border-none justify-start gap-3 w-full group">
                            <i class="fa-solid fa-file-prescription text-[#D4AF37] group-hover:scale-110 transition-transform"></i>
                            <span>Historial de Recetas</span>
                        </a>
                        <a href="{{ url('/citas/pagos') }}" class="btn bg-[#26262B] hover:bg-[#323239] text-white border-none justify-start gap-3 w-full group">
                            <i class="fa-solid fa-file-invoice-dollar text-[#D4AF37] group-hover:scale-110 transition-transform"></i>
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

                <div class="lg:col-span-2 bg-[#1A1A1E] border border-[#3A3A40]/40 rounded-xl p-6 shadow-xl flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-[#D4AF37] border-b border-[#3A3A40]/60 pb-2 mb-4">
                            Próximas Consultas en Agenda
                        </h4>

                        <div class="space-y-3">
                            @forelse($proximasCitas as $cita)
                                <div class="flex items-center justify-between p-3 bg-[#26262B] rounded-lg border-l-4 border-[#D4AF37]/60">
                                    <div class="text-xs">
                                        <p class="font-bold text-white text-sm">{{ $cita->p_nom }} {{ $cita->p_ape }}</p>
                                        <p class="text-gray-400 mt-0.5">Médico: Dr. {{ $cita->d_ape }}</p>
                                    </div>
                                    <div class="text-right text-xs">
                                        <span class="badge bg-[#1A1A1E] border border-[#3A3A40] text-gray-300 font-mono p-2">
                                            {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m') }} — {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-xs text-gray-500 italic">
                                    <i class="fa-solid fa-calendar-day text-lg mb-2 block text-gray-600"></i>
                                    No hay citas pendientes programadas para los próximos días.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="text-right text-[10px] text-gray-600 font-mono mt-4 pt-2 border-t border-[#3A3A40]/40">
                        MEDACARE v12.0 // CHIMBOTE, PERÚ
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
