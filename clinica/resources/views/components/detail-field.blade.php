@props(['label', 'fullWidth' => false])

<div @class([
    'rounded-lg bg-gray-50 border border-gray-100 px-4 py-3',
    'md:col-span-2' => $fullWidth,
])>
    <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">{{ $label }}</dt>
    <dd class="mt-1 text-sm text-gray-900">{{ $slot }}</dd>
</div>
