<button {{ $attributes->merge(['type' => 'button', 'class' => 'clinic-btn-secondary inline-flex items-center justify-center px-5 py-2.5 bg-white border border-clinic-turquoise-pastel rounded-lg font-semibold text-xs text-clinic-navy uppercase tracking-wider shadow-[var(--shadow-clinic-sm)] hover:bg-clinic-mint/80 hover:border-clinic-accent/40 focus:outline-none focus:ring-2 focus:ring-clinic-accent/30 focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
