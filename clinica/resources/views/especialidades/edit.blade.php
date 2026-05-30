<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Specialty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="form-control w-full">
                            <label class="label" for="nombre">
                                <span class="label-text">{{ __('Name') }}</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $especialidad->nombre) }}" class="input input-bordered w-full @error('nombre') input-error @enderror" required>
                            @error('nombre')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="descripcion">
                                <span class="label-text">{{ __('Description') }}</span>
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="3" class="textarea textarea-bordered w-full @error('descripcion') textarea-error @enderror">{{ old('descripcion', $especialidad->descripcion) }}</textarea>
                            @error('descripcion')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" name="estado" value="1" class="checkbox checkbox-primary" {{ old('estado', $especialidad->estado) ? 'checked' : '' }}>
                                <span class="label-text">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="card-actions justify-end gap-2">
                            <a href="{{ route('especialidades.index') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
