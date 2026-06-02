@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center gap-3 w-full px-3 py-2.5 rounded-lg border-l-4 border-clinic-accent bg-clinic-cyan-pastel/50 text-sm font-semibold text-clinic-purple-dark focus:outline-none'
    : 'flex items-center gap-3 w-full px-3 py-2.5 rounded-lg border-l-4 border-transparent text-sm font-medium text-clinic-muted hover:text-clinic-navy hover:bg-clinic-turquoise-pastel/35 focus:outline-none clinic-nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
