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
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title">{{ $especialidad->nombre }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><span class="font-semibold">{{ __('ID') }}:</span> {{ $especialidad->id }}</div>
                        <div><span class="font-semibold">{{ __('Status') }}:</span> <x-status-badge :active="(bool) $especialidad->estado" /></div>
                        <div class="md:col-span-2"><span class="font-semibold">{{ __('Description') }}:</span> {{ $especialidad->descripcion ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('Doctors in this specialty') }}</h3>
                    <div class="overflow-x-auto">
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
                                        <td colspan="7" class="text-center text-gray-500">{{ __('No doctors assigned to this specialty.') }}</td>
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
