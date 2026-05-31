@props([
    'action',
    'message' => null,
])

@php
    $modalId = 'confirm-delete-' . md5($action);
@endphp

<button
    type="button"
    {{ $attributes->merge(['class' => 'btn btn-error btn-xs']) }}
    x-data=""
    x-on:click="$dispatch('open-modal', '{{ $modalId }}')"
>
    {{ $slot->isEmpty() ? __('Delete') : $slot }}
</button>

<x-modal :name="$modalId">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Confirm deletion') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ $message ?? __('Are you sure you want to delete this record? This action cannot be undone.') }}
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
                @method('DELETE')
                <button type="submit" class="btn btn-error">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</x-modal>
