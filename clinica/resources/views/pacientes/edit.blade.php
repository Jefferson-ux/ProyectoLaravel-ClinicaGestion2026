<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-form-card>
                <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-field :label="__('DNI')" for="dni" :error="$errors->first('dni')">
                            <input type="text" id="dni" name="dni" value="{{ old('dni', $paciente->dni) }}" maxlength="8"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('dni') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Birth Date')" for="fecha_nacimiento" :error="$errors->first('fecha_nacimiento')">
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('fecha_nacimiento') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>

                        <x-form-field :label="__('First Name')" for="nombres" :error="$errors->first('nombres')">
                            <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $paciente->nombres) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('nombres') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Last Name')" for="apellidos" :error="$errors->first('apellidos')">
                            <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('apellidos') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                required>
                        </x-form-field>

                        <x-form-field :label="__('Phone')" for="telefono" :error="$errors->first('telefono')">
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('telefono') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>

                        <x-form-field :label="__('Email')" for="correo" :error="$errors->first('correo')">
                            <input type="email" id="correo" name="correo" value="{{ old('correo', $paciente->correo) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('correo') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>

                        <x-form-field :label="__('Address')" for="direccion" :error="$errors->first('direccion')" class="md:col-span-2">
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $paciente->direccion) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('direccion') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        </x-form-field>
                    </div>

                    <div class="flex items-center gap-3 rounded-lg bg-gray-50 border border-gray-100 px-4 py-3">
                        <input type="checkbox" name="estado" value="1" id="estado"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            {{ old('estado', $paciente->estado) ? 'checked' : '' }}>
                        <label for="estado" class="text-sm font-medium text-gray-700">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="{{ route('pacientes.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </x-form-card>
        </div>
    </div>
</x-app-layout>
