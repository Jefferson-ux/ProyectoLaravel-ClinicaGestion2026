@props(['title' => null])

<div {{ $attributes->merge(['class' => 'clinic-card overflow-hidden sm:rounded-xl']) }}>
    <div class="p-6 sm:p-8">
        @if ($title)
            <h3 class="text-lg font-semibold text-clinic-purple-dark mb-6 pb-4 border-b border-clinic-turquoise-pastel/60">{{ $title }}</h3>
        @endif
        {{ $slot }}
    </div>
</div>
