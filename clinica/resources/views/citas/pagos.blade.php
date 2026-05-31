<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cash audit — All payments') }}
            </h2>
            <a href="{{ route('citas.index') }}" class="btn btn-ghost btn-sm">{{ __('Back to appointments') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-success />
            <x-flash-error />

            @if (auth()->user()->rol !== 'admin')
                <div class="alert alert-warning mb-4 shadow-sm">
                    <span>{{ __('Voiding payments is restricted to administrators.') }}</span>
                </div>
            @endif

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto px-4 py-4 sm:px-5">
                        <table id="tabla-clinica" class="display w-full">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Appointment') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Patient') }}</th>
                                    <th>{{ __('Doctor') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment Date') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pagos as $pago)
                                    <tr @class(['opacity-60' => $pago->estado === 'ANULADO'])>
                                        <td>{{ $pago->id }}</td>
                                        <td>#{{ $pago->id_cita }}</td>
                                        <td>{{ $pago->fecha }} {{ \Illuminate\Support\Str::of($pago->hora)->substr(0, 5) }}</td>
                                        <td>{{ $pago->paciente_nombres }} {{ $pago->paciente_apellidos }}</td>
                                        <td>Dr. {{ $pago->doctor_nombres }} {{ $pago->doctor_apellidos }}</td>
                                        <td>{{ number_format((float) $pago->monto, 2) }}</td>
                                        <td>{{ $pago->fecha_pago ?? '—' }}</td>
                                        <td>{{ $pago->metodo_pago ?? '—' }}</td>
                                        <td>
                                            @if ($pago->estado === 'PAGADO')
                                                <span class="badge badge-success">{{ $pago->estado }}</span>
                                            @else
                                                <span class="badge badge-error">{{ $pago->estado }}</span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap space-x-1">
                                            <a href="{{ route('citas.show', $pago->id_cita) }}" class="btn btn-ghost btn-xs">{{ __('Appointment') }}</a>
                                            @if ($pago->estado === 'PAGADO' && auth()->user()->rol === 'admin')
                                                <x-confirm-deactivate
                                                    :action="route('citas.pagos.anular', $pago->id)"
                                                    method="PATCH"
                                                    :label="__('Void')"
                                                    :confirm-label="__('Void payment')"
                                                    class="inline"
                                                    :message="__('The payment will be marked as ANULADO. This action cannot be undone and the amount cannot be edited.')"
                                                />
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-gray-500 py-6">{{ __('No payments registered.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
