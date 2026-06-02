<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                <i class="fa-solid fa-calendar-check text-clinic-accent"></i> {{ __('Appointment Details') }} #{{ $cita->id }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-primary btn-sm">{{ __('Edit / Close consultation') }}</a>
                <a href="{{ route('citas.index') }}" class="btn btn-ghost btn-sm border border-clinic-turquoise-pastel/60">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash-success />

            <x-detail-card :title="__('Appointment Information')">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-detail-field :label="__('Date')">{{ $cita->fecha }}</x-detail-field>
                    <x-detail-field :label="__('Time')">{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</x-detail-field>
                    <x-detail-field :label="__('Status')">
                        @php
                            $badgeClass = match ($cita->estado) {
                                'ATENDIDO' => 'badge-success',
                                'CANCELADO' => 'badge-error',
                                default => 'badge-warning',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $cita->estado }}</span>
                    </x-detail-field>
                    <x-detail-field :label="__('Reason')" :full-width="true">{{ $cita->motivo ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Patient')">{{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</x-detail-field>
                    <x-detail-field :label="__('Doctor')">Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</x-detail-field>
                    <x-detail-field :label="__('Specialty')" :full-width="true">{{ $cita->doctor?->especialidad?->nombre ?? '—' }}</x-detail-field>
                </dl>
            </x-detail-card>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <x-detail-card :title="__('Prescription')">
                    @php $receta = $cita->recetas->first(); @endphp
                    @if ($receta)
                        <dl class="space-y-4 text-sm">
                            <div class="clinic-modal-section">
                                <span class="font-semibold text-clinic-navy">{{ __('Description') }}:</span>
                                <p class="mt-1 text-clinic-ink">{{ $receta->descripcion ?? '—' }}</p>
                            </div>
                            <div class="clinic-modal-section">
                                <span class="font-semibold text-clinic-navy">{{ __('Medications') }}:</span>
                                <p class="mt-1 text-clinic-ink">{{ $receta->medicamentos ?? '—' }}</p>
                            </div>
                            <div class="clinic-modal-section">
                                <span class="font-semibold text-clinic-navy">{{ __('Recommendations') }}:</span>
                                <p class="mt-1 text-clinic-ink">{{ $receta->recomendaciones ?? '—' }}</p>
                            </div>
                        </dl>
                        <div class="mt-5">
                            <a href="{{ route('citas.recetas.edit', $receta->id) }}" class="btn btn-primary btn-sm">{{ __('Edit prescription') }}</a>
                        </div>
                    @else
                        <p class="text-sm text-clinic-muted">{{ __('No prescription yet. Mark the appointment as ATENDIDO to register one.') }}</p>
                    @endif
                </x-detail-card>

                <x-detail-card :title="__('Payment')">
                    @php $pago = $cita->pagos->first(); @endphp
                    @if ($pago)
                        <dl class="space-y-3 text-sm">
                            <x-detail-field :label="__('Amount')">{{ number_format((float) $pago->monto, 2) }}</x-detail-field>
                            <x-detail-field :label="__('Payment Date')">{{ $pago->fecha_pago ?? '—' }}</x-detail-field>
                            <x-detail-field :label="__('Method')">{{ $pago->metodo_pago ?? '—' }}</x-detail-field>
                            <div class="rounded-lg bg-clinic-mint/80 border border-clinic-turquoise-pastel/50 px-4 py-3">
                                <dt class="text-xs font-medium uppercase tracking-wide text-clinic-muted">{{ __('Status') }}</dt>
                                <dd class="mt-1">
                                    @if ($pago->estado === 'PAGADO')
                                        <span class="badge badge-success">{{ $pago->estado }}</span>
                                    @else
                                        <span class="badge badge-error">{{ $pago->estado }}</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                        <p class="mt-4 text-xs text-clinic-muted">{{ __('Payments cannot be edited. Void only from cash audit (admin).') }}</p>
                    @else
                        <p class="text-sm text-clinic-muted">{{ __('No payment registered yet.') }}</p>
                    @endif
                </x-detail-card>
            </div>
        </div>
    </div>
</x-app-layout>
