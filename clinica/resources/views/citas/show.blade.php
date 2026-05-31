<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Appointment Details') }} #{{ $cita->id }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-info btn-sm">{{ __('Edit / Close consultation') }}</a>
                <a href="{{ route('citas.index') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
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
                        <dl class="space-y-3 text-sm">
                            <div><span class="font-semibold text-gray-600">{{ __('Description') }}:</span> {{ $receta->descripcion ?? '—' }}</div>
                            <div><span class="font-semibold text-gray-600">{{ __('Medications') }}:</span> {{ $receta->medicamentos ?? '—' }}</div>
                            <div><span class="font-semibold text-gray-600">{{ __('Recommendations') }}:</span> {{ $receta->recomendaciones ?? '—' }}</div>
                        </dl>
                        <div class="mt-4">
                            <a href="{{ route('citas.recetas.edit', $receta->id) }}" class="btn btn-info btn-sm">{{ __('Edit prescription') }}</a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">{{ __('No prescription yet. Mark the appointment as ATENDIDO to register one.') }}</p>
                    @endif
                </x-detail-card>

                <x-detail-card :title="__('Payment')">
                    @php $pago = $cita->pagos->first(); @endphp
                    @if ($pago)
                        <dl class="space-y-3 text-sm">
                            <div><span class="font-semibold text-gray-600">{{ __('Amount') }}:</span> {{ number_format((float) $pago->monto, 2) }}</div>
                            <div><span class="font-semibold text-gray-600">{{ __('Payment Date') }}:</span> {{ $pago->fecha_pago ?? '—' }}</div>
                            <div><span class="font-semibold text-gray-600">{{ __('Method') }}:</span> {{ $pago->metodo_pago ?? '—' }}</div>
                            <div>
                                <span class="font-semibold text-gray-600">{{ __('Status') }}:</span>
                                @if ($pago->estado === 'PAGADO')
                                    <span class="badge badge-success">{{ $pago->estado }}</span>
                                @else
                                    <span class="badge badge-error">{{ $pago->estado }}</span>
                                @endif
                            </div>
                        </dl>
                        <p class="mt-4 text-xs text-gray-500">{{ __('Payments cannot be edited. Void only from cash audit (admin).') }}</p>
                    @else
                        <p class="text-sm text-gray-500">{{ __('No payment registered yet.') }}</p>
                    @endif
                </x-detail-card>
            </div>
        </div>
    </div>
</x-app-layout>
