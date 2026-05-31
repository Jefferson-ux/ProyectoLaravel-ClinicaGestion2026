@props([
    'action',
    'label' => null,
    'message' => null,
    'confirmLabel' => null,
    'method' => 'DELETE',
])

@php
    $modalId = 'confirm-deactivate-' . md5($action);
    $buttonLabel = $label ?? __('Deactivate');
    $submitLabel = $confirmLabel ?? $buttonLabel;
@endphp

<button
    type="button"
    {{ $attributes->merge(['class' => 'btn btn-error btn-xs']) }}
    x-data=""
    x-on:click="$dispatch('open-modal', '{{ $modalId }}')"
>
    {{ $slot->isEmpty() ? $buttonLabel : $slot }}
</button>

<x-modal :name="$modalId">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Confirm deactivation') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ $message ?? __('This record will be marked as inactive. You can reactivate it later from the inactive list.') }}
        </p>
        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                class="btn btn-ghost"
                x-on:click="$dispatch('close-modal', '{{ $modalId }}')"
            >
                {{ __('Cancel') }}
            </button>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method($method)
                <button type="submit" class="btn btn-error">
                    {{ $submitLabel }}
                </button>
            </form>
        </div>
    </div>
</x-modal>
