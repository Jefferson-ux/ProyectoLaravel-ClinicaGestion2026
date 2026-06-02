@props([
    'receta' => null,
    'pago' => null,
])

<div
    x-show="estado === 'ATENDIDO'"
    x-cloak
    class="space-y-6 rounded-lg border border-indigo-200 bg-indigo-50/50 p-6"
>
    <h4 class="text-sm font-semibold text-indigo-900">{{ __('Close consultation — Prescription & Payment') }}</h4>

    <div class="space-y-4">
        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">{{ __('Prescription') }}</p>

        <x-form-field :label="__('Description')" for="descripcion" :error="$errors->first('descripcion')">
            <textarea id="descripcion" name="descripcion" rows="2"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $receta?->descripcion) }}</textarea>
        </x-form-field>

        <x-form-field :label="__('Medications')" for="medicamentos" :error="$errors->first('medicamentos')">
            <textarea id="medicamentos" name="medicamentos" rows="2"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('medicamentos', $receta?->medicamentos) }}</textarea>
        </x-form-field>

        <x-form-field :label="__('Recommendations')" for="recomendaciones" :error="$errors->first('recomendaciones')">
            <textarea id="recomendaciones" name="recomendaciones" rows="2"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('recomendaciones', $receta?->recomendaciones) }}</textarea>
        </x-form-field>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-indigo-200 pt-4">
        <p class="md:col-span-3 text-xs font-medium uppercase tracking-wide text-gray-500">{{ __('Payment') }}</p>

        <x-form-field :label="__('Amount')" for="monto" :error="$errors->first('monto')">
            <input type="number" id="monto" name="monto" step="0.01" min="0"
                value="{{ old('monto', $pago?->monto) }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('monto') border-red-500 @enderror">
        </x-form-field>

        <x-form-field :label="__('Payment Date')" for="fecha_pago">
            <input type="date" id="fecha_pago" name="fecha_pago"
                value="{{ old('fecha_pago', $pago?->fecha_pago ?? now()->toDateString()) }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
        </x-form-field>

        <x-form-field :label="__('Payment Method')" for="metodo_pago">
            <select id="metodo_pago" name="metodo_pago"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
                <option value="">{{ __('Select payment method') }}</option>
                <option value="CASH" {{ old('metodo_pago', $pago?->metodo_pago) === 'CASH' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                <option value="CARD" {{ old('metodo_pago', $pago?->metodo_pago) === 'CARD' ? 'selected' : '' }}>{{ __('Card') }}</option>
                <option value="TRANSFER" {{ old('metodo_pago', $pago?->metodo_pago) === 'TRANSFER' ? 'selected' : '' }}>{{ __('Transfer') }}</option>
            </select>
        </x-form-field>
    </div>
</div>
