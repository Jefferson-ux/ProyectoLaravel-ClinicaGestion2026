<button {{ $attributes->merge(['type' => 'submit', 'class' => 'clinic-btn-primary inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-clinic-accent to-clinic-navy border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider shadow-[var(--shadow-clinic-sm)] hover:from-clinic-accent-hover hover:to-clinic-purple-dark focus:outline-none focus:ring-2 focus:ring-clinic-accent/40 focus:ring-offset-2 focus:ring-offset-clinic-mint']) }}>
    {{ $slot }}
</button>
