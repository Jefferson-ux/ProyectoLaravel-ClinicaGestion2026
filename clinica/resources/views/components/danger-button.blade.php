<button {{ $attributes->merge(['type' => 'submit', 'class' => 'clinic-btn-primary inline-flex items-center justify-center px-5 py-2.5 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider shadow-[var(--shadow-clinic-sm)] hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
