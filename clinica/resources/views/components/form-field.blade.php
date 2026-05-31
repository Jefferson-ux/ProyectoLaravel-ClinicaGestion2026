@props(['label', 'for', 'error' => null])

<div {{ $attributes->merge(['class' => 'space-y-1.5']) }}>
    <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    {{ $slot }}
    @if ($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
