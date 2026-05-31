<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-form-card>
                <form action="{{ route('citas.update', $cita->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field :label="__('Patient')" for="id_paciente" :error="$errors->first('id_paciente')">
                            <select id="id_paciente" name="id_paciente"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('id_paciente') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                                <option value="">{{ __('Select patient') }}</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ old('id_paciente', $cita->id_paciente) == $paciente->id ? 'selected' : '' }}>
                                        [{{ $paciente->id }}] {{ $paciente->nombres }} {{ $paciente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form-field>

                        <x-form-field :label="__('Doctor')" for="id_doctor" :error="$errors->first('id_doctor')">
                            <select id="id_doctor" name="id_doctor"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('id_doctor') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                                <option value="">{{ __('Select doctor') }}</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('id_doctor', $cita->id_doctor) == $doctor->id ? 'selected' : '' }}>
                                        [{{ $doctor->id }}] Dr. {{ $doctor->nombres }} {{ $doctor->apellidos }} — {{ $doctor->especialidad?->nombre ?? __('No specialty') }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form-field>

                        <x-form-field :label="__('Date')" for="fecha" :error="$errors->first('fecha')">
                            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $cita->fecha) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('fecha') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Time')" for="hora" :error="$errors->first('hora')">
                            <input type="time" id="hora" name="hora" value="{{ old('hora', \Illuminate\Support\Str::of($cita->hora)->substr(0, 5)) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('hora') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Status')" for="estado" :error="$errors->first('estado')">
                            <select id="estado" name="estado"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('estado') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="PENDIENTE" {{ old('estado', $cita->estado) === 'PENDIENTE' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="CONFIRMADA" {{ old('estado', $cita->estado) === 'CONFIRMADA' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                <option value="COMPLETADA" {{ old('estado', $cita->estado) === 'COMPLETADA' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                <option value="CANCELADA" {{ old('estado', $cita->estado) === 'CANCELADA' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                            </select>
                        </x-form-field>
                    </div>

                    <x-form-field :label="__('Reason')" for="motivo" :error="$errors->first('motivo')">
                        <textarea id="motivo" name="motivo" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('motivo') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('motivo', $cita->motivo) }}</textarea>
                    </x-form-field>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="{{ route('citas.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </x-form-card>
        </div>
    </div>
</x-app-layout>
