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
        <div class="modal-box clinic-modal-box max-w-lg">
            <h3 class="font-bold text-lg text-clinic-navy">
                <i class="fa-solid fa-file-lines text-clinic-accent mr-1"></i>
                {{ __('Appointment summary') }} #<span x-text="cita.id"></span>
            </h3>
            <p class="text-sm text-clinic-muted mt-2 px-1">
                <span x-text="cita.paciente"></span> · Dr. <span x-text="cita.doctor"></span>
            </p>

            <div class="divider my-3 before:bg-clinic-turquoise-pastel/40 after:bg-clinic-turquoise-pastel/40"></div>

            <div class="space-y-4 text-sm">
                <div class="clinic-modal-section">
                    <p class="font-semibold text-clinic-navy mb-2">{{ __('Prescription') }}</p>
                    <p class="mt-1"><span class="font-medium text-clinic-muted">{{ __('Description') }}:</span> <span class="text-clinic-ink" x-text="cita.descripcion || '—'"></span></p>
                    <p class="mt-2"><span class="font-medium text-clinic-muted">{{ __('Medications') }}:</span> <span class="text-clinic-ink" x-text="cita.medicamentos || '—'"></span></p>
                    <p class="mt-2"><span class="font-medium text-clinic-muted">{{ __('Recommendations') }}:</span> <span class="text-clinic-ink" x-text="cita.recomendaciones || '—'"></span></p>
                </div>
                <div class="clinic-modal-section">
                    <p class="font-semibold text-clinic-navy mb-2">{{ __('Payment') }}</p>
                    <p class="mt-1"><span class="font-medium text-clinic-muted">{{ __('Amount') }}:</span> <span class="text-clinic-ink" x-text="cita.monto ?? '—'"></span></p>
                    <p class="mt-2"><span class="font-medium text-clinic-muted">{{ __('Payment Date') }}:</span> <span class="text-clinic-ink" x-text="cita.fecha_pago || '—'"></span></p>
                    <p class="mt-2"><span class="font-medium text-clinic-muted">{{ __('Method') }}:</span> <span class="text-clinic-ink" x-text="cita.metodo_pago || '—'"></span></p>
                    <p class="mt-2 flex items-center gap-2 flex-wrap">
                        <span class="font-medium text-clinic-muted">{{ __('Status') }}:</span>
                        <span class="badge badge-sm" :class="cita.pago_estado === 'PAGADO' ? 'badge-success' : (cita.pago_estado === 'ANULADO' ? 'badge-error' : 'badge-ghost')" x-text="cita.pago_estado || '—'"></span>
                    </p>
                </div>
            </div>

            <div class="modal-action mt-6 pt-2 border-t border-clinic-turquoise-pastel/40">
                <button type="button" class="btn btn-ghost border border-clinic-turquoise-pastel/50" @click="closeModal()">{{ __('Close') }}</button>
                <a :href="cita.show_url" class="btn btn-primary btn-sm">{{ __('Full details') }}</a>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-clinic-ink/40">
            <button type="button" @click="closeModal()">{{ __('Close') }}</button>
        </form>
    </dialog>
</div>
