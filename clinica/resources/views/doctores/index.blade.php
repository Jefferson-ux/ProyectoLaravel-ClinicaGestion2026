<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Doctors') }}
            </h2>
            <a href="{{ route('doctores.create') }}" class="btn btn-primary btn-sm">
                {{ __('Add Doctor') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-success />

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div style="overflow-x: auto; padding: 15px 20px;">
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
                                    <tr>
                                        <td>{{ $doctor->id }}</td>
                                        <td>{{ $doctor->dni }}</td>
                                        <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                                        <td>{{ $doctor->id_especialidad ?? '—' }}</td>
                                        <td>{{ $doctor->especialidad?->nombre ?? '—' }}</td>
                                        <td>{{ $doctor->telefono ?? '—' }}</td>
                                        <td>{{ $doctor->correo ?? '—' }}</td>
                                        <td><x-status-badge :active="(bool) $doctor->estado" /></td>
                                        <td class="space-x-1 whitespace-nowrap">
                                            <a href="{{ route('doctores.show', $doctor->id) }}" class="btn btn-ghost btn-xs">{{ __('View') }}</a>
                                            <a href="{{ route('doctores.edit', $doctor->id) }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>
                                            <form action="{{ route('doctores.destroy', $doctor->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this record?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error btn-xs">{{ __('Delete') }}</button>
                                            </form>
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
