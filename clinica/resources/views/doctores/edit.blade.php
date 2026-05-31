<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Doctor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-form-card>
                <form action="{{ route('doctores.update', $doctor->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field :label="__('DNI')" for="dni" :error="$errors->first('dni')">
                            <input type="text" id="dni" name="dni" value="{{ old('dni', $doctor->dni) }}" maxlength="8"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('dni') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Specialty')" for="id_especialidad" :error="$errors->first('id_especialidad')">
                            <select id="id_especialidad" name="id_especialidad"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('id_especialidad') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="">{{ __('Select specialty') }}</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}" {{ old('id_especialidad', $doctor->id_especialidad) == $especialidad->id ? 'selected' : '' }}>
                                        [{{ $especialidad->id }}] {{ $especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form-field>

                        <x-form-field :label="__('First Name')" for="nombres" :error="$errors->first('nombres')">
                            <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $doctor->nombres) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('nombres') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Last Name')" for="apellidos" :error="$errors->first('apellidos')">
                            <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $doctor->apellidos) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('apellidos') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Phone')" for="telefono" :error="$errors->first('telefono')">
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $doctor->telefono) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('telefono') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>

                        <x-form-field :label="__('Email')" for="correo" :error="$errors->first('correo')">
                            <input type="email" id="correo" name="correo" value="{{ old('correo', $doctor->correo) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('correo') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>
                    </div>

                    <div class="flex items-center gap-3 rounded-lg bg-gray-50 border border-gray-100 px-4 py-3">
                        <input type="checkbox" name="estado" value="1" id="estado"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            {{ old('estado', $doctor->estado) ? 'checked' : '' }}>
                        <label for="estado" class="text-sm font-medium text-gray-700">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="{{ route('doctores.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </x-form-card>
        </div>
    </div>
</x-app-layout>
