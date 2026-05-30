<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Appointment Details') }} #{{ $cita->id }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                <a href="{{ route('citas.index') }}" class="btn btn-ghost btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash-success />

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Appointment Information') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><span class="font-semibold">{{ __('Date') }}:</span> {{ $cita->fecha }}</div>
                        <div><span class="font-semibold">{{ __('Time') }}:</span> {{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</div>
                        <div><span class="font-semibold">{{ __('Status') }}:</span> <span class="badge badge-outline">{{ $cita->estado }}</span></div>
                        <div class="md:col-span-2"><span class="font-semibold">{{ __('Reason') }}:</span> {{ $cita->motivo ?? '—' }}</div>
                        <div><span class="font-semibold">{{ __('Patient ID') }}:</span> {{ $cita->id_paciente }}</div>
                        <div><span class="font-semibold">{{ __('Patient') }}:</span> {{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</div>
                        <div><span class="font-semibold">{{ __('Doctor ID') }}:</span> {{ $cita->id_doctor }}</div>
                        <div><span class="font-semibold">{{ __('Doctor') }}:</span> Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</div>
                        <div class="md:col-span-2"><span class="font-semibold">{{ __('Specialty') }}:</span> {{ $cita->doctor?->especialidad?->nombre ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('Prescriptions') }}</h3>
                        <div class="overflow-x-auto mb-6">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Appointment ID') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Medications') }}</th>
                                        <th>{{ __('Recommendations') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cita->recetas as $receta)
                                        <tr>
                                            <td>{{ $receta->id }}</td>
                                            <td>{{ $receta->id_cita }}</td>
                                            <td>{{ $receta->descripcion ?? '—' }}</td>
                                            <td>{{ $receta->medicamentos ?? '—' }}</td>
                                            <td>{{ $receta->recomendaciones ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500">{{ __('No prescriptions yet.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('citas.receta.store', $cita->id) }}" method="POST" class="space-y-3 border-t pt-4">
                            @csrf
                            <h4 class="font-semibold">{{ __('Add Prescription') }}</h4>
                            <div class="form-control w-full">
                                <label class="label" for="descripcion"><span class="label-text">{{ __('Description') }}</span></label>
                                <textarea id="descripcion" name="descripcion" rows="2" class="textarea textarea-bordered w-full">{{ old('descripcion') }}</textarea>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="medicamentos"><span class="label-text">{{ __('Medications') }}</span></label>
                                <textarea id="medicamentos" name="medicamentos" rows="2" class="textarea textarea-bordered w-full">{{ old('medicamentos') }}</textarea>
                            </div>
                            <div class="form-control w-full">
                                <label class="label" for="recomendaciones"><span class="label-text">{{ __('Recommendations') }}</span></label>
                                <textarea id="recomendaciones" name="recomendaciones" rows="2" class="textarea textarea-bordered w-full">{{ old('recomendaciones') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary btn-sm">{{ __('Save Prescription') }}</button>
                        </form>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('Payments') }}</h3>
                        <div class="overflow-x-auto mb-6">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Appointment ID') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Payment Date') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cita->pagos as $pago)
                                        <tr>
                                            <td>{{ $pago->id }}</td>
                                            <td>{{ $pago->id_cita }}</td>
                                            <td>{{ number_format($pago->monto, 2) }}</td>
                                            <td>{{ $pago->fecha_pago ?? '—' }}</td>
                                            <td>{{ $pago->metodo_pago ?? '—' }}</td>
                                            <td><span class="badge badge-outline">{{ $pago->estado }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-gray-500">{{ __('No payments yet.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('citas.pago.store', $cita->id) }}" method="POST" class="space-y-3 border-t pt-4">
                            @csrf
                            <h4 class="font-semibold">{{ __('Register Payment') }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="form-control w-full">
                                    <label class="label" for="monto"><span class="label-text">{{ __('Amount') }}</span></label>
                                    <input type="number" id="monto" name="monto" step="0.01" min="0" value="{{ old('monto') }}" class="input input-bordered w-full @error('monto') input-error @enderror" required>
                                    @error('monto')<span class="text-error text-sm mt-1">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-control w-full">
                                    <label class="label" for="fecha_pago"><span class="label-text">{{ __('Payment Date') }}</span></label>
                                    <input type="date" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', now()->toDateString()) }}" class="input input-bordered w-full">
                                </div>
                                <div class="form-control w-full">
                                    <label class="label" for="metodo_pago"><span class="label-text">{{ __('Payment Method') }}</span></label>
                                    <select id="metodo_pago" name="metodo_pago" class="select select-bordered w-full">
                                        <option value="">{{ __('Select method') }}</option>
                                        <option value="CASH" {{ old('metodo_pago') === 'CASH' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                                        <option value="CARD" {{ old('metodo_pago') === 'CARD' ? 'selected' : '' }}>{{ __('Card') }}</option>
                                        <option value="TRANSFER" {{ old('metodo_pago') === 'TRANSFER' ? 'selected' : '' }}>{{ __('Transfer') }}</option>
                                    </select>
                                </div>
                                <div class="form-control w-full">
                                    <label class="label" for="pago_estado"><span class="label-text">{{ __('Status') }}</span></label>
                                    <select id="pago_estado" name="estado" class="select select-bordered w-full">
                                        <option value="PAGADO" {{ old('estado', 'PAGADO') === 'PAGADO' ? 'selected' : '' }}>{{ __('Paid') }}</option>
                                        <option value="PENDIENTE" {{ old('estado') === 'PENDIENTE' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-secondary btn-sm">{{ __('Save Payment') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
