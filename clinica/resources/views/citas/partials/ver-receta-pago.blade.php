<div
    x-data="{
        open: false,
        cita: {},
        openModal(payload) {
            this.cita = payload;
            this.open = true;
            this.$refs.dialog.showModal();
        },
        closeModal() {
            this.open = false;
            this.$refs.dialog.close();
        }
    }"
    @open-receta-pago.window="openModal($event.detail)"
>
    <dialog x-ref="dialog" class="modal" @close="open = false">
        <div class="modal-box max-w-lg">
            <h3 class="font-bold text-lg text-gray-900">
                {{ __('Appointment summary') }} #<span x-text="cita.id"></span>
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                <span x-text="cita.paciente"></span> · Dr. <span x-text="cita.doctor"></span>
            </p>

            <div class="divider my-2"></div>

            <div class="space-y-4 text-sm">
                <div>
                    <p class="font-semibold text-gray-700">{{ __('Prescription') }}</p>
                    <p class="mt-1"><span class="font-medium">{{ __('Description') }}:</span> <span x-text="cita.descripcion || '—'"></span></p>
                    <p class="mt-1"><span class="font-medium">{{ __('Medications') }}:</span> <span x-text="cita.medicamentos || '—'"></span></p>
                    <p class="mt-1"><span class="font-medium">{{ __('Recommendations') }}:</span> <span x-text="cita.recomendaciones || '—'"></span></p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">{{ __('Payment') }}</p>
                    <p class="mt-1"><span class="font-medium">{{ __('Amount') }}:</span> <span x-text="cita.monto ?? '—'"></span></p>
                    <p class="mt-1"><span class="font-medium">{{ __('Payment Date') }}:</span> <span x-text="cita.fecha_pago || '—'"></span></p>
                    <p class="mt-1"><span class="font-medium">{{ __('Method') }}:</span> <span x-text="cita.metodo_pago || '—'"></span></p>
                    <p class="mt-1">
                        <span class="font-medium">{{ __('Status') }}:</span>
                        <span class="badge badge-sm" :class="cita.pago_estado === 'PAGADO' ? 'badge-success' : (cita.pago_estado === 'ANULADO' ? 'badge-error' : 'badge-ghost')" x-text="cita.pago_estado || '—'"></span>
                    </p>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button type="button" class="btn btn-ghost" @click="closeModal()">{{ __('Close') }}</button>
                </form>
                <a :href="cita.show_url" class="btn btn-primary btn-sm">{{ __('Full details') }}</a>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button type="button" @click="closeModal()">{{ __('Close') }}</button>
        </form>
    </dialog>
</div>
