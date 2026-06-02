@props([
    'action',
    'label' => '✕',
    'message' => null,
    'confirmLabel' => null,
    'method' => 'DELETE',
])

@php
    $modalId = 'confirm-deactivate-' . md5($action);
    $buttonLabel = $label;
    $submitLabel = $confirmLabel ?? $buttonLabel;
@endphp

<button
    type="button"
    {{ $attributes->merge(['class' => 'border-none bg-transparent p-0 m-0 outline-none focus:outline-none flex items-center']) }}
    x-data=""
    x-on:click="$dispatch('open-modal', '{{ $modalId }}')"
>
    <span class="btn bg-rose-600 hover:bg-rose-700 border-none btn-xs text-white shadow-sm shadow-rose-600/20 hover:shadow-md hover:shadow-rose-600/40 rounded-md transition-all duration-200 hover:scale-105 active:scale-95 inline-flex items-center justify-center">
        {{ $slot->isEmpty() ? $buttonLabel : $slot }}
    </span>
</button>

@teleport('body')
    <x-modal :name="$modalId">
        <div class="relative z-[999] p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-900">
                {{ __('Confirm deactivation') }}
            </h2>

            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                {{ $message ?? __('This record will be marked as inactive. You can reactivate it later from the inactive list.') }}
            </p>

<div class="mt-6 flex justify-end gap-3">
    <button
        type="button"
        class="border-none bg-transparent p-0 m-0 outline-none focus:outline-none flex items-center"
        x-on:click="$dispatch('close-modal', '{{ $modalId }}')"
    >
        <span class="btn bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 border-none btn-sm text-gray-700 dark:text-gray-200 shadow-sm shadow-gray-500/10 hover:shadow-md hover:shadow-gray-500/20 rounded-md transition-all duration-200 hover:scale-105 active:scale-95 inline-flex items-center justify-center font-semibold px-4">
            {{ __('Cancel') }}
        </span>
    </button>

    <form action="{{ $action }}" method="POST" class="inline">
        @csrf
        @method($method)
        <button
            type="submit"
            class="border-none bg-transparent p-0 m-0 outline-none focus:outline-none flex items-center"
        >
            <span class="btn bg-rose-600 hover:bg-rose-700 border-none btn-sm text-white shadow-md shadow-rose-600/20 hover:shadow-lg hover:shadow-rose-600/40 rounded-md transition-all duration-200 hover:scale-105 active:scale-95 inline-flex items-center justify-center font-semibold px-4">
                {{ $submitLabel }}
            </span>
        </button>
    </form>
</div>
        </div>
    </x-modal>
@endteleport