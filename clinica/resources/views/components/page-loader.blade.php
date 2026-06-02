<div
    id="clinic-page-loader"
    class="clinic-page-loader"
    style="position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;background:#fff;"
    role="status"
    aria-live="polite"
    aria-busy="true"
    aria-label="{{ __('Loading...') }}"
>
    <div class="clinic-page-loader__backdrop"></div>
    <div class="clinic-page-loader__panel">
        <div class="clinic-page-loader__brand">
            <x-application-logo class="h-10 w-10 text-clinic-accent fill-current" />
            <span class="clinic-page-loader__title">MediaCare</span>
        </div>
        <div class="clinic-page-loader__spinner" aria-hidden="true"></div>
        <p class="clinic-page-loader__text">{{ __('Loading...') }}</p>
    </div>
</div>
