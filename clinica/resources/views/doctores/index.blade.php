<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Doctors') }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <x-toggle-inactivos :index-route="route('doctores.index')" />
                <a href="{{ route('doctores.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Add Doctor') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <th>{{ __('Specialty ID') }}</th>
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctores as $doctor)
                                    <tr @class(['opacity-60' => ! $doctor->estado])>
                                        <td>{{ $doctor->id }}</td>
                                        <td>{{ $doctor->dni }}</td>
                                        <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                                        <td>{{ $doctor->id_especialidad ?? '—' }}</td>
                                        <td>{{ $doctor->especialidad?->nombre ?? '—' }}</td>
                                        <td>{{ $doctor->telefono ?? '—' }}</td>
                                        <td>{{ $doctor->correo ?? '—' }}</td>
                                        <td><x-status-badge :active="(bool) $doctor->estado" /></td>
                                        <td>
                                            <x-master-actions
                                                :record="$doctor"
                                                :show-route="route('doctores.show', $doctor->id)"
                                                :edit-route="route('doctores.edit', $doctor->id)"
                                                :destroy-route="route('doctores.destroy', $doctor->id)"
                                                :restore-route="route('doctores.restore', $doctor->id)"
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
