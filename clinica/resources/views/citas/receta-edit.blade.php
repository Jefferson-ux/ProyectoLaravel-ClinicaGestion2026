<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit prescription') }} #{{ $receta->id }}
            </h2>
            <a href="{{ route('citas.recetas') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 rounded-lg bg-gray-50 border border-gray-200 p-4 text-sm text-gray-600">
                {{ __('Appointment') }} #{{ $receta->id_cita }} · {{ $receta->fecha }}
                {{ \Illuminate\Support\Str::of($receta->hora)->substr(0, 5) }} ·
                {{ $receta->paciente_nombres }} {{ $receta->paciente_apellidos }} ·
                Dr. {{ $receta->doctor_nombres }} {{ $receta->doctor_apellidos }}
            </div>

            <x-form-card>
                <form action="{{ route('citas.recetas.update', $receta->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <x-form-field :label="__('Description')" for="descripcion" :error="$errors->first('descripcion')">
                        <textarea id="descripcion" name="descripcion" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('descripcion', $receta->descripcion) }}</textarea>
                    </x-form-field>

                    <x-form-field :label="__('Medications')" for="medicamentos" :error="$errors->first('medicamentos')">
                        <textarea id="medicamentos" name="medicamentos" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('medicamentos', $receta->medicamentos) }}</textarea>
                    </x-form-field>

                    <x-form-field :label="__('Recommendations')" for="recomendaciones" :error="$errors->first('recomendaciones')">
                        <textarea id="recomendaciones" name="recomendaciones" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('recomendaciones', $receta->recomendaciones) }}</textarea>
                    </x-form-field>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">
                        <a href="{{ route('citas.recetas') }}" class="btn btn-ghost">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </form>
            </x-form-card>
        </div>
    </div>
</x-app-layout>
