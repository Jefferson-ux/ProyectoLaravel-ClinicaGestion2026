<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-book-medical"></i> {{ __('Appointments') }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('citas.recetas') }}" class="btn btn-outline btn-sm">{{ __('All prescriptions') }}</a>
                <a href="{{ route('citas.pagos') }}" class="btn btn-outline btn-sm">{{ __('Cash audit') }}</a>
                <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Schedule Appointment') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[100%] mx-auto sm:px-6 lg:px-8">
            <x-flash-success />
            <x-flash-error />

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto px-4 py-4 sm:px-5">
                        <table id="tabla-clinica" class="display w-full">
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
                                        <td>{{ $cita->motivo ?? '—' }}</td>
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
                                        <td class="space-x-1 whitespace-nowrap">
                                            <button
                                                type="button"
                                                class="btn btn-ghost btn-xs"
                                                @click="$dispatch('open-receta-pago', {
                                                    id: {{ $cita->id }},
                                                    paciente: @js(trim(($cita->paciente?->nombres ?? '') . ' ' . ($cita->paciente?->apellidos ?? ''))),
                                                    doctor: @js(trim(($cita->doctor?->nombres ?? '') . ' ' . ($cita->doctor?->apellidos ?? ''))),
                                                    descripcion: @js($receta?->descripcion),
                                                    medicamentos: @js($receta?->medicamentos),
                                                    recomendaciones: @js($receta?->recomendaciones),
                                                    monto: @js($pago?->monto),
                                                    fecha_pago: @js($pago?->fecha_pago),
                                                    metodo_pago: @js($pago?->metodo_pago),
                                                    pago_estado: @js($pago?->estado),
                                                    show_url: @js(route('citas.show', $cita->id)),
                                                })"
                                            >{{ __('Summary') }}</button>
                                            <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-ghost btn-xs">{{ __('View') }}</a>
                                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>
                                            <x-confirm-deactivate
                                            :action="route('citas.destroy', $cita->id)"
                                            :label="__('Cancel')"
                                            :confirm-label="__('Cancel appointment')"
                                            class="inline"
                                            :message="__('The appointment will be marked as CANCELADO and associated payments will be voided (ANULADO).')"

                                            {{-- 🌟 PASAMOS EL ESTADO DISABLED SI YA ESTÁ CANCELADO --}}
                                            :disabled="$cita->estado === 'CANCELADO'"
                                        />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('citas.partials.ver-receta-pago')
</x-app-layout>
