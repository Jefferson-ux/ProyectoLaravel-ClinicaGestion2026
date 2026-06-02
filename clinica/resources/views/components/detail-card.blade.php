@props(['title'])

<div {{ $attributes->merge(['class' => 'clinic-form-panel overflow-hidden']) }}>
    <h3 class="text-lg font-semibold text-clinic-purple-dark mb-6 pb-4 border-b border-clinic-turquoise-pastel/60">{{ $title }}</h3>
    {{ $slot }}
</div>
