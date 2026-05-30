@props(['active' => true])

<span {{ $attributes->merge(['class' => 'badge ' . ($active ? 'badge-success' : 'badge-error')]) }}>
    {{ $active ? __('Active') : __('Inactive') }}
</span>
