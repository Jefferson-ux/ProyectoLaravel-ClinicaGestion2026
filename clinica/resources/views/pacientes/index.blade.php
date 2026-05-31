<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patients') }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <x-toggle-inactivos :index-route="route('pacientes.index')" />
                <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Add Patient') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[100%] mx-auto sm:px-6 lg:px-8">
            <x-flash-success />

            @if ($verInactivos)
                <div class="alert alert-info mb-4 shadow-sm">
                    <span>{{ __('Showing active and inactive records.') }}</span>
                </div>
            @endif

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto px-4 py-4 sm:px-5">
                        <table id="tabla-clinica" class="display w-full">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('DNI') }}</th>
                                    <th>{{ __('Full Name') }}</th>
                                    <th>{{ __('Birth Date') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Appointments') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr @class(['opacity-60' => ! $paciente->estado])>
                                        <td>{{ $paciente->id }}</td>
                                        <td>{{ $paciente->dni }}</td>
                                        <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                                        <td>{{ $paciente->fecha_nacimiento ?? '—' }}</td>
                                        <td>{{ $paciente->telefono ?? '—' }}</td>
                                        <td>{{ $paciente->correo ?? '—' }}</td>
                                        <td>{{ $paciente->citas_count }}</td>
                                        <td><x-status-badge :active="(bool) $paciente->estado" /></td>
                                        <td>
                                            <x-master-actions
                                                :record="$paciente"
                                                :show-route="route('pacientes.show', $paciente->id)"
                                                :edit-route="route('pacientes.edit', $paciente->id)"
                                                :destroy-route="route('pacientes.destroy', $paciente->id)"
                                                :restore-route="route('pacientes.restore', $paciente->id)"
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
</x-app-layout>
