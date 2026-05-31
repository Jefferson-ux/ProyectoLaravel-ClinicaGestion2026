<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Specialty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-form-card>
                <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <x-form-field :label="__('Name')" for="nombre" :error="$errors->first('nombre')">
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $especialidad->nombre) }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('nombre') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            required>
                    </x-form-field>

                    <x-form-field :label="__('Description')" for="descripcion" :error="$errors->first('descripcion')">
                        <textarea id="descripcion" name="descripcion" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('descripcion') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('descripcion', $especialidad->descripcion) }}</textarea>
                    </x-form-field>

                    <div class="flex items-center gap-3 rounded-lg bg-gray-50 border border-gray-100 px-4 py-3">
                        <input type="checkbox" name="estado" value="1" id="estado"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            {{ old('estado', $especialidad->estado) ? 'checked' : '' }}>
                        <label for="estado" class="text-sm font-medium text-gray-700">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="{{ route('especialidades.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </x-form-card>
        </div>
    </div>
</x-app-layout>
