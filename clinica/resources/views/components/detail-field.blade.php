@props(['label', 'fullWidth' => false])

<div @class([
    'rounded-lg bg-clinic-mint/70 border border-clinic-turquoise-pastel/50 px-4 py-3.5',
    'md:col-span-2' => $fullWidth,
])>
    <dt class="text-xs font-medium uppercase tracking-wide text-clinic-muted">{{ $label }}</dt>
    <dd class="mt-1.5 text-sm text-clinic-ink">{{ $slot }}</dd>
</div>
