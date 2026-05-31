<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-capsules"></i> {{ __('Prescriptions audit') }}
            </h2>
            <a href="{{ route('citas.index') }}" class="btn btn-ghost btn-sm">{{ __('Back to appointments') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[100%] mx-auto sm:px-6 lg:px-8">
            <x-flash-success />
            <x-flash-error />

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto px-4 py-4 sm:px-5">
                        <table id="tabla-clinica" class="display w-full">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Appointment') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Patient') }}</th>
                                    <th>{{ __('Doctor') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Medications') }}</th>
                                    <th>{{ __('Appointment Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recetas as $receta)
                                    <tr>
                                        <td>{{ $receta->id }}</td>
                                        <td>#{{ $receta->id_cita }}</td>
                                        <td>{{ $receta->fecha }} {{ \Illuminate\Support\Str::of($receta->hora)->substr(0, 5) }}</td>
                                        <td>{{ $receta->paciente_nombres }} {{ $receta->paciente_apellidos }}</td>
                                        <td>Dr. {{ $receta->doctor_nombres }} {{ $receta->doctor_apellidos }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($receta->descripcion ?? '—', 40) }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($receta->medicamentos ?? '—', 40) }}</td>
                                        <td><span class="badge badge-outline">{{ $receta->cita_estado }}</span></td>
                                        <td class="whitespace-nowrap space-x-1">
                                            <a href="{{ route('citas.recetas.edit', $receta->id) }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>
                                            <a href="{{ route('citas.show', $receta->id_cita) }}" class="btn btn-ghost btn-xs">{{ __('Appointment') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-gray-500 py-6">{{ __('No prescriptions registered.') }}</td>
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
