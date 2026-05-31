@props([
    'record',
    'showRoute',
    'editRoute',
    'destroyRoute',
    'restoreRoute',
])

<div class="space-x-1 whitespace-nowrap">
    <a href="{{ $showRoute }}" class="btn btn-ghost btn-xs">{{ __('View') }}</a>
    <a href="{{ $editRoute }}" class="btn btn-info btn-xs">{{ __('Edit') }}</a>

    @if ($record->estado)
        <x-confirm-deactivate
            :action="$destroyRoute"
            class="inline"
            :message="__('The record will be deactivated (logical delete). Historical data will be preserved.')"
        />
    @else
        <form action="{{ $restoreRoute }}" method="POST" class="inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success btn-xs">{{ __('Activate') }}</button>
        </form>
    @endif
</div>
