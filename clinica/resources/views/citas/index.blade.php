<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Appointments') }}
            </h2>
            <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">
                {{ __('Schedule Appointment') }}
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
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Patient ID') }}</th>
                                    <th>{{ __('Patient') }}</th>
                                    <th>{{ __('Doctor ID') }}</th>
                                    <th>{{ __('Doctor') }}</th>
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Reason') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->id }}</td>
                                        <td>{{ $cita->fecha }}</td>
                                        <td>{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</td>
                                        <td>{{ $cita->id_paciente }}</td>
                                        <td>{{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</td>
                                        <td>{{ $cita->id_doctor }}</td>
                                        <td>Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</td>
                                        <td>{{ $cita->doctor?->especialidad?->nombre ?? '—' }}</td>
                                        <td>{{ $cita->motivo ?? '—' }}</td>
                                        <td><span class="badge badge-outline">{{ $cita->estado }}</span></td>
                                        <td class="space-x-1 whitespace-nowrap">
                                            <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-ghost btn-xs">{{ __('View') }}</a>
                                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>
                                            <x-delete-button :action="route('citas.destroy', $cita->id)" class="inline" />
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
