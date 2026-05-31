<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Specialty Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('especialidades.edit', $especialidad->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                <a href="{{ route('especialidades.index') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-detail-card :title="$especialidad->nombre">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-detail-field :label="__('ID')">{{ $especialidad->id }}</x-detail-field>
                    <x-detail-field :label="__('Status')"><x-status-badge :active="(bool) $especialidad->estado" /></x-detail-field>
                    <x-detail-field :label="__('Description')" :full-width="true">{{ $especialidad->descripcion ?? '—' }}</x-detail-field>
                </dl>
            </x-detail-card>

            <x-detail-card :title="__('Doctors in this specialty')">
                <div class="overflow-x-auto -mx-2 sm:mx-0 px-2 sm:px-0">
                    <table id="tabla-clinica" class="display w-full">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('DNI') }}</th>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __('Specialty ID') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($especialidad->doctores as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    <td>{{ $doctor->dni }}</td>
                                    <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                                    <td>{{ $doctor->id_especialidad }} — {{ $especialidad->nombre }}</td>
                                    <td>{{ $doctor->telefono ?? '—' }}</td>
                                    <td>{{ $doctor->correo ?? '—' }}</td>
                                    <td><x-status-badge :active="(bool) $doctor->estado" /></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-6">{{ __('No doctors assigned to this specialty.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-detail-card>
        </div>
    </div>
</x-app-layout>
