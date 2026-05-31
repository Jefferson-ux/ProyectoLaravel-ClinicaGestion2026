<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Specialties') }}
            </h2>
            <a href="{{ route('especialidades.create') }}" class="btn btn-primary btn-sm">
                {{ __('Add Specialty') }}
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
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Doctors') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidades as $especialidad)
                                    <tr>
                                        <td>{{ $especialidad->id }}</td>
                                        <td>{{ $especialidad->nombre }}</td>
                                        <td>{{ $especialidad->descripcion ?? '—' }}</td>
                                        <td>{{ $especialidad->doctores_count }}</td>
                                        <td><x-status-badge :active="(bool) $especialidad->estado" /></td>
                                        <td class="space-x-1 whitespace-nowrap">
                                            <a href="{{ route('especialidades.show', $especialidad->id) }}" class="btn btn-ghost btn-xs">{{ __('View') }}</a>
                                            <a href="{{ route('especialidades.edit', $especialidad->id) }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>
                                            <x-delete-button :action="route('especialidades.destroy', $especialidad->id)" class="inline" />
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
