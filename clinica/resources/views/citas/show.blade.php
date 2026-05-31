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

            <x-detail-card :title="__('Appointment Information')">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-detail-field :label="__('Date')">{{ $cita->fecha }}</x-detail-field>
                    <x-detail-field :label="__('Time')">{{ \Illuminate\Support\Str::of($cita->hora)->substr(0, 5) }}</x-detail-field>
                    <x-detail-field :label="__('Status')"><span class="badge badge-outline">{{ $cita->estado }}</span></x-detail-field>
                    <x-detail-field :label="__('Reason')" :full-width="true">{{ $cita->motivo ?? '—' }}</x-detail-field>
                    <x-detail-field :label="__('Patient ID')">{{ $cita->id_paciente }}</x-detail-field>
                    <x-detail-field :label="__('Patient')">{{ $cita->paciente?->nombres }} {{ $cita->paciente?->apellidos }}</x-detail-field>
                    <x-detail-field :label="__('Doctor ID')">{{ $cita->id_doctor }}</x-detail-field>
                    <x-detail-field :label="__('Doctor')">Dr. {{ $cita->doctor?->nombres }} {{ $cita->doctor?->apellidos }}</x-detail-field>
                    <x-detail-field :label="__('Specialty')" :full-width="true">{{ $cita->doctor?->especialidad?->nombre ?? '—' }}</x-detail-field>
                </dl>
            </x-detail-card>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <x-detail-card :title="__('Prescriptions')">
                    <div class="overflow-x-auto mb-6 -mx-2 sm:mx-0 px-2 sm:px-0">
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
                                        <td colspan="5" class="text-center text-gray-500 py-6">{{ __('No prescriptions yet.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('citas.receta.store', $cita->id) }}" method="POST" class="space-y-4 border-t border-gray-200 pt-6">
                        @csrf
                        <h4 class="text-sm font-semibold text-gray-900">{{ __('Add Prescription') }}</h4>
                        <x-form-field :label="__('Description')" for="descripcion">
                            <textarea id="descripcion" name="descripcion" rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('descripcion') }}</textarea>
                        </x-form-field>
                        <x-form-field :label="__('Medications')" for="medicamentos">
                            <textarea id="medicamentos" name="medicamentos" rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('medicamentos') }}</textarea>
                        </x-form-field>
                        <x-form-field :label="__('Recommendations')" for="recomendaciones">
                            <textarea id="recomendaciones" name="recomendaciones" rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">{{ old('recomendaciones') }}</textarea>
                        </x-form-field>
                        <button type="submit" class="btn btn-secondary btn-sm">{{ __('Save Prescription') }}</button>
                    </form>
                </x-detail-card>

                <x-detail-card :title="__('Payments')">
                    <div class="overflow-x-auto mb-6 -mx-2 sm:mx-0 px-2 sm:px-0">
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
                                        <td colspan="6" class="text-center text-gray-500 py-6">{{ __('No payments yet.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('citas.pago.store', $cita->id) }}" method="POST" class="space-y-4 border-t border-gray-200 pt-6">
                        @csrf
                        <h4 class="text-sm font-semibold text-gray-900">{{ __('Register Payment') }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form-field :label="__('Amount')" for="monto" :error="$errors->first('monto')">
                                <input type="number" id="monto" name="monto" step="0.01" min="0" value="{{ old('monto') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 @error('monto') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required>
                            </x-form-field>
                            <x-form-field :label="__('Payment Date')" for="fecha_pago">
                                <input type="date" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', now()->toDateString()) }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
                            </x-form-field>
                            <x-form-field :label="__('Payment Method')" for="metodo_pago">
                                <select id="metodo_pago" name="metodo_pago"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
                                    <option value="">{{ __('Select method') }}</option>
                                    <option value="CASH" {{ old('metodo_pago') === 'CASH' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                                    <option value="CARD" {{ old('metodo_pago') === 'CARD' ? 'selected' : '' }}>{{ __('Card') }}</option>
                                    <option value="TRANSFER" {{ old('metodo_pago') === 'TRANSFER' ? 'selected' : '' }}>{{ __('Transfer') }}</option>
                                </select>
                            </x-form-field>
                            <x-form-field :label="__('Status')" for="pago_estado">
                                <select id="pago_estado" name="estado"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
                                    <option value="PAGADO" {{ old('estado', 'PAGADO') === 'PAGADO' ? 'selected' : '' }}>{{ __('Paid') }}</option>
                                    <option value="PENDIENTE" {{ old('estado') === 'PENDIENTE' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                </select>
                            </x-form-field>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-sm">{{ __('Save Payment') }}</button>
                    </form>
                </x-detail-card>
            </div>
        </div>
    </div>
</x-app-layout>
