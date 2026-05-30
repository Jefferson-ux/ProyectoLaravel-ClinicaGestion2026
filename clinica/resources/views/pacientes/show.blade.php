<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patient Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                <a href="{{ route('pacientes.index') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title">{{ $paciente->nombres }} {{ $paciente->apellidos }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><span class="font-semibold">{{ __('ID') }}:</span> {{ $paciente->id }}</div>
                        <div><span class="font-semibold">{{ __('DNI') }}:</span> {{ $paciente->dni }}</div>
                        <div><span class="font-semibold">{{ __('Birth Date') }}:</span> {{ $paciente->fecha_nacimiento ?? '—' }}</div>
                        <div><span class="font-semibold">{{ __('Phone') }}:</span> {{ $paciente->telefono ?? '—' }}</div>
                        <div><span class="font-semibold">{{ __('Email') }}:</span> {{ $paciente->correo ?? '—' }}</div>
                        <div><span class="font-semibold">{{ __('Status') }}:</span> <x-status-badge :active="(bool) $paciente->estado" /></div>
                        <div class="md:col-span-2"><span class="font-semibold">{{ __('Address') }}:</span> {{ $paciente->direccion ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('Appointments') }}</h3>
                    <div class="overflow-x-auto">
                        <table id="tabla-clinica" class="display w-full">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Doctor ID') }}</th>
                                    <th>{{ __('Doctor') }}</th>
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Reason') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paciente->citas as $cita)
                                    <tr>
                                        <td>
                                            <a href="{{ route('citas.show', $cita->id) }}" class="link link-primary">{{ $cita->id }}</a>
                                        </td>
                                        <td>{{ $cita->fecha }}</td>
                                        <td>{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</td>
                                        <td>{{ $cita->id_doctor }}</td>
                                        <td>Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</td>
                                        <td>{{ $cita->doctor?->especialidad?->nombre ?? '—' }}</td>
                                        <td>{{ $cita->motivo ?? '—' }}</td>
                                        <td><span class="badge badge-outline">{{ $cita->estado }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-gray-500">{{ __('No appointments found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
