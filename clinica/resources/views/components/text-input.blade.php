@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'clinic-input block w-full border border-clinic-turquoise-pastel/60 bg-white text-clinic-ink placeholder:text-clinic-muted/60 focus:border-clinic-accent focus:ring-2 focus:ring-clinic-accent/25 rounded-lg shadow-[var(--shadow-clinic-sm)] transition-colors duration-200']) }}>
