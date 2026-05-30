<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label" for="dni"><span class="label-text">{{ __('DNI') }}</span></label>
                                <input type="text" id="dni" name="dni" value="{{ old('dni', $paciente->dni) }}" maxlength="8" class="input input-bordered w-full @error('dni') input-error @enderror" required>
                                @error('dni')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="fecha_nacimiento"><span class="label-text">{{ __('Birth Date') }}</span></label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" class="input input-bordered w-full @error('fecha_nacimiento') input-error @enderror">
                                @error('fecha_nacimiento')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="nombres"><span class="label-text">{{ __('First Name') }}</span></label>
                                <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $paciente->nombres) }}" class="input input-bordered w-full @error('nombres') input-error @enderror" required>
                                @error('nombres')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="apellidos"><span class="label-text">{{ __('Last Name') }}</span></label>
                                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}" class="input input-bordered w-full @error('apellidos') input-error @enderror" required>
                                @error('apellidos')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="telefono"><span class="label-text">{{ __('Phone') }}</span></label>
                                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" class="input input-bordered w-full @error('telefono') input-error @enderror">
                                @error('telefono')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="correo"><span class="label-text">{{ __('Email') }}</span></label>
                                <input type="email" id="correo" name="correo" value="{{ old('correo', $paciente->correo) }}" class="input input-bordered w-full @error('correo') input-error @enderror">
                                @error('correo')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-control w-full md:col-span-2">
                                <label class="label" for="direccion"><span class="label-text">{{ __('Address') }}</span></label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $paciente->direccion) }}" class="input input-bordered w-full @error('direccion') input-error @enderror">
                                @error('direccion')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" name="estado" value="1" class="checkbox checkbox-primary" {{ old('estado', $paciente->estado) ? 'checked' : '' }}>
                                <span class="label-text">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="card-actions justify-end gap-2">
                            <a href="{{ route('pacientes.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
