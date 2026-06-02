@props([
    'receta' => null,
    'pago' => null,
])

<div
    x-show="estado === 'ATENDIDO'"
    x-cloak
    class="clinic-form-section space-y-6"
>
    <h4 class="text-sm font-semibold text-clinic-navy">
        <i class="fa-solid fa-notes-medical text-clinic-accent mr-1"></i>
        {{ __('Close consultation — Prescription & Payment') }}
    </h4>

    <div class="space-y-4">
        <p class="text-xs font-medium uppercase tracking-wide text-clinic-muted">{{ __('Prescription') }}</p>

        <x-form-field :label="__('Description')" for="descripcion" :error="$errors->first('descripcion')">
            <textarea id="descripcion" name="descripcion" rows="3" class="textarea textarea-bordered w-full @error('descripcion') textarea-error @enderror">{{ old('descripcion', $receta?->descripcion) }}</textarea>
        </x-form-field>

        <x-form-field :label="__('Medications')" for="medicamentos" :error="$errors->first('medicamentos')">
            <textarea id="medicamentos" name="medicamentos" rows="3" class="textarea textarea-bordered w-full @error('medicamentos') textarea-error @enderror">{{ old('medicamentos', $receta?->medicamentos) }}</textarea>
        </x-form-field>

        <x-form-field :label="__('Recommendations')" for="recomendaciones" :error="$errors->first('recomendaciones')">
            <textarea id="recomendaciones" name="recomendaciones" rows="3" class="textarea textarea-bordered w-full @error('recomendaciones') textarea-error @enderror">{{ old('recomendaciones', $receta?->recomendaciones) }}</textarea>
        </x-form-field>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 border-t border-clinic-turquoise-pastel/50 pt-5">
        <p class="md:col-span-3 text-xs font-medium uppercase tracking-wide text-clinic-muted">{{ __('Payment') }}</p>

        <x-form-field :label="__('Amount')" for="monto" :error="$errors->first('monto')">
            <input type="number" id="monto" name="monto" step="0.01" min="0"
                value="{{ old('monto', $pago?->monto) }}"
                class="input input-bordered w-full @error('monto') input-error @enderror">
        </x-form-field>

        <x-form-field :label="__('Payment Date')" for="fecha_pago">
            <input type="date" id="fecha_pago" name="fecha_pago"
                value="{{ old('fecha_pago', $pago?->fecha_pago ?? now()->toDateString()) }}"
                class="input input-bordered w-full">
        </x-form-field>

        <x-form-field :label="__('Payment Method')" for="metodo_pago">
            <select id="metodo_pago" name="metodo_pago" class="select select-bordered w-full">
                <option value="">{{ __('Select payment method') }}</option>
                <option value="CASH" {{ old('metodo_pago', $pago?->metodo_pago) === 'CASH' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                <option value="CARD" {{ old('metodo_pago', $pago?->metodo_pago) === 'CARD' ? 'selected' : '' }}>{{ __('Card') }}</option>
                <option value="TRANSFER" {{ old('metodo_pago', $pago?->metodo_pago) === 'TRANSFER' ? 'selected' : '' }}>{{ __('Transfer') }}</option>
            </select>
        </x-form-field>
    </div>
</div>
