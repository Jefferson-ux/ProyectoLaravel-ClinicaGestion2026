@props(['indexRoute'])

@php
    $verInactivos = request()->boolean('ver_inactivos');
@endphp

<a
    href="{{ $verInactivos ? $indexRoute : $indexRoute . '?ver_inactivos=1' }}"
    {{ $attributes->merge(['class' => 'btn btn-sm ' . ($verInactivos ? 'btn-warning' : 'btn-outline')]) }}
>
    {{ $verInactivos ? __('View active only') : __('View inactive records') }}
</a>
