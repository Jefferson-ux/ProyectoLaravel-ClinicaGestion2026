<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form action="{{ route('citas.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label" for="id_paciente"><span class="label-text">{{ __('Patient') }}</span></label>
                                <select id="id_paciente" name="id_paciente" class="select select-bordered w-full @error('id_paciente') select-error @enderror" required>
                                    <option value="">{{ __('Select patient') }}</option>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}" {{ old('id_paciente') == $paciente->id ? 'selected' : '' }}>
                                            [{{ $paciente->id }}] {{ $paciente->nombres }} {{ $paciente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_paciente')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="id_doctor"><span class="label-text">{{ __('Doctor') }}</span></label>
                                <select id="id_doctor" name="id_doctor" class="select select-bordered w-full @error('id_doctor') select-error @enderror" required>
                                    <option value="">{{ __('Select doctor') }}</option>
                                    @foreach ($doctores as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('id_doctor') == $doctor->id ? 'selected' : '' }}>
                                            [{{ $doctor->id }}] Dr. {{ $doctor->nombres }} {{ $doctor->apellidos }} — {{ $doctor->especialidad?->nombre ?? __('No specialty') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_doctor')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="fecha"><span class="label-text">{{ __('Date') }}</span></label>
                                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" class="input input-bordered w-full @error('fecha') input-error @enderror" required>
                                @error('fecha')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="hora"><span class="label-text">{{ __('Time') }}</span></label>
                                <input type="time" id="hora" name="hora" value="{{ old('hora') }}" class="input input-bordered w-full @error('hora') input-error @enderror" required>
                                @error('hora')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                        </div>

                        <p class="text-sm text-gray-500">{{ __('New appointments are created with status PENDIENTE.') }}</p>

                        <div class="form-control w-full">
                            <label class="label" for="motivo"><span class="label-text">{{ __('Reason') }}</span></label>
                            <textarea id="motivo" name="motivo" rows="3" class="textarea textarea-bordered w-full @error('motivo') textarea-error @enderror">{{ old('motivo') }}</textarea>
                            @error('motivo')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                        </div>

                        <div class="card-actions justify-end gap-2">
                            <a href="{{ route('citas.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
