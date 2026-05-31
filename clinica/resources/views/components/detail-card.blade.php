@props(['title'])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200']) }}>
    <div class="p-6 sm:p-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-200">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>
