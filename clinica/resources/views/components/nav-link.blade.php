@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center gap-3 w-full px-3 py-2.5 rounded-lg border-l-4 border-clinic-accent bg-clinic-cyan-pastel/50 text-sm font-semibold text-clinic-purple-dark shadow-[var(--shadow-clinic-sm)] focus:outline-none focus:ring-2 focus:ring-clinic-accent/30'
    : 'flex items-center gap-3 w-full px-3 py-2.5 rounded-lg border-l-4 border-transparent text-sm font-medium text-clinic-muted hover:text-clinic-navy hover:bg-clinic-turquoise-pastel/35 hover:border-clinic-turquoise-pastel focus:outline-none focus:text-clinic-navy focus:bg-clinic-mint/60 focus:border-clinic-cyan-pastel clinic-nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
