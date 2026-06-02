<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <i class="fa-solid fa-pen-to-square text-clinic-accent"></i> {{ __('Edit Appointment') }} #{{ $cita->id }}
        </h2>
    </x-slot>

    <div class="py-8 bg-white">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="clinic-form-panel">
                <form
                    action="{{ route('citas.update', $cita->id) }}"
                    method="POST"
                    class="space-y-6"
                    x-data="{ estado: '{{ old('estado', $cita->estado) }}' }"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <x-form-field :label="__('Patient')" for="id_paciente" :error="$errors->first('id_paciente')">
                            <select id="id_paciente" name="id_paciente" class="select select-bordered w-full @error('id_paciente') select-error @enderror" required>
                                <option value="">{{ __('Select patient') }}</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ old('id_paciente', $cita->id_paciente) == $paciente->id ? 'selected' : '' }}>
                                        [{{ $paciente->id }}] {{ $paciente->nombres }} {{ $paciente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form-field>

                        <x-form-field :label="__('Doctor')" for="id_doctor" :error="$errors->first('id_doctor')">
                            <select id="id_doctor" name="id_doctor" class="select select-bordered w-full @error('id_doctor') select-error @enderror" required>
                                <option value="">{{ __('Select doctor') }}</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('id_doctor', $cita->id_doctor) == $doctor->id ? 'selected' : '' }}>
                                        [{{ $doctor->id }}] Dr. {{ $doctor->nombres }} {{ $doctor->apellidos }} — {{ $doctor->especialidad?->nombre ?? __('No specialty') }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form-field>

                        <x-form-field :label="__('Date')" for="fecha" :error="$errors->first('fecha')">
                            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $cita->fecha) }}" class="input input-bordered w-full @error('fecha') input-error @enderror" required>
                        </x-form-field>

                        <x-form-field :label="__('Time')" for="hora" :error="$errors->first('hora')">
                            <input type="time" id="hora" name="hora" value="{{ old('hora', \Illuminate\Support\Str::of($cita->hora)->substr(0, 5)) }}" class="input input-bordered w-full @error('hora') input-error @enderror" required>
                        </x-form-field>

                        <x-form-field :label="__('Status')" for="estado" :error="$errors->first('estado')">
                            <select id="estado" name="estado" x-model="estado" class="select select-bordered w-full @error('estado') select-error @enderror">
                                <option value="PENDIENTE">{{ __('Pending') }}</option>
                                <option value="ATENDIDO">{{ __('Attended') }}</option>
                                <option value="CANCELADO">{{ __('Cancelled') }}</option>
                            </select>
                        </x-form-field>
                    </div>

                    <x-form-field :label="__('Reason')" for="motivo" :error="$errors->first('motivo')">
                        <textarea id="motivo" name="motivo" rows="4" class="textarea textarea-bordered w-full @error('motivo') textarea-error @enderror">{{ old('motivo', $cita->motivo) }}</textarea>
                    </x-form-field>

                    @include('citas.partials.formulario-atender', ['receta' => $receta, 'pago' => $pago])

                    <div class="clinic-form-actions">
                        <a href="{{ route('citas.index') }}" class="btn btn-ghost border border-clinic-turquoise-pastel/60">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
