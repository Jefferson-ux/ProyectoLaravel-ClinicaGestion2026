<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-briefcase"></i> {{ __('Specialties') }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <x-toggle-inactivos :index-route="route('especialidades.index')" />
                <a href="{{ route('especialidades.create') }}" class="btn btn-primary btn-sm">
                    {{ __('Add Specialty') }}
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
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Doctors') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidades as $especialidad)
                                    <tr @class(['opacity-60' => ! $especialidad->estado])>
                                        <td>{{ $especialidad->id }}</td>
                                        <td>{{ $especialidad->nombre }}</td>
                                        <td>{{ $especialidad->descripcion ?? '—' }}</td>
                                        <td>{{ $especialidad->doctores_count }}</td>
                                        <td><x-status-badge :active="(bool) $especialidad->estado" /></td>
                                        <td>
                                            <x-master-actions
                                                :record="$especialidad"
                                                :show-route="route('especialidades.show', $especialidad->id)"
                                                :edit-route="route('especialidades.edit', $especialidad->id)"
                                                :destroy-route="route('especialidades.destroy', $especialidad->id)"
                                                :restore-route="route('especialidades.restore', $especialidad->id)"
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
