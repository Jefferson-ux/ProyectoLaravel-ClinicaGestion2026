<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                <i class="fa-solid fa-book-medical text-clinic-accent"></i> {{ __('Appointments') }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('citas.recetas') }}" class="btn btn-outline btn-sm border-clinic-turquoise-pastel text-clinic-navy hover:bg-clinic-mint">{{ __('All prescriptions') }}</a>
                <a href="{{ route('citas.pagos') }}" class="btn btn-outline btn-sm border-clinic-turquoise-pastel text-clinic-navy hover:bg-clinic-mint">{{ __('Cash audit') }}</a>
                <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Schedule Appointment') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-white">
        <div class="max-w-[100%] mx-auto sm:px-6 lg:px-8">
            <x-flash-success />
            <x-flash-error />

            <div class="clinic-table-card rounded-xl overflow-hidden">
                <div class="clinic-table-wrap overflow-x-auto">
                    <table id="tabla-clinica" class="display w-full clinic-data-table">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Doctor') }}</th>
                                <th>{{ __('Specialty') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                @php
                                    $receta = $cita->recetas->first();
                                    $pago = $cita->pagos->first();
                                @endphp
                                <tr>
                                    <td>{{ $cita->id }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</td>
                                    <td>{{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</td>
                                    <td>Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</td>
                                    <td>{{ $cita->doctor?->especialidad?->nombre ?? '—' }}</td>
                                    <td class="max-w-[8rem] truncate" title="{{ $cita->motivo }}">{{ $cita->motivo ?? '—' }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match ($cita->estado) {
                                                'ATENDIDO' => 'badge-success',
                                                'CANCELADO' => 'badge-error',
                                                default => 'badge-warning',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $cita->estado }}</span>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="flex flex-wrap items-center gap-0.5">

                                            <a href="{{ route('citas.show', $cita->id) }}" title="{{ __('View details') }}" class="btn btn-ghost btn-xs text-clinic-accent hover:bg-clinic-cyan-pastel">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-info btn-xs" title="{{ __('Edit') }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <x-confirm-deactivate
                                                :action="route('citas.destroy', $cita->id)"
                                                title="Cancelar"
                                                :label="'✕'"
                                                :confirm-label="__('Cancel appointment')"
                                                class="inline"
                                                :message="__('The appointment will be marked as CANCELADO and associated payments will be voided (ANULADO).')"
                                                :disabled="$cita->estado === 'CANCELADO'"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @include('citas.partials.ver-receta-pago')
</x-app-layout>
