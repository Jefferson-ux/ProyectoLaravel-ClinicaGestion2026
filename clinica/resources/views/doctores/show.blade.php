<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Doctor Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('doctores.edit', $doctor->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                <a href="{{ route('doctores.index') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-detail-card :title="'Dr. ' . $doctor->nombres . ' ' . $doctor->apellidos">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-detail-field :label="__('ID')">{{ $doctor->id }}</x-detail-field>
                    <x-detail-field :label="__('DNI')">{{ $doctor->dni }}</x-detail-field>
                    <x-detail-field :label="__('Specialty ID')">{{ $doctor->id_especialidad ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Specialty')">{{ $doctor->especialidad?->nombre ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Phone')">{{ $doctor->telefono ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Email')">{{ $doctor->correo ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Status')"><x-status-badge :active="(bool) $doctor->estado" /></x-detail-field>
                </dl>
            </x-detail-card>

            <x-detail-card :title="__('Appointments')">
                <div class="overflow-x-auto -mx-2 sm:mx-0 px-2 sm:px-0">
                    <table id="tabla-clinica" class="display w-full">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Patient ID') }}</th>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctor->citas as $cita)
                                <tr>
                                    <td>
                                        <a href="{{ route('citas.show', $cita->id) }}" class="link link-primary">{{ $cita->id }}</a>
                                    </td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</td>
                                    <td>{{ $cita->id_paciente }}</td>
                                    <td>{{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</td>
                                    <td>{{ $cita->motivo ?? '—' }}</td>
                                    <td><span class="badge badge-outline">{{ $cita->estado }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-6">{{ __('No appointments found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-detail-card>
        </div>
    </div>
</x-app-layout>
