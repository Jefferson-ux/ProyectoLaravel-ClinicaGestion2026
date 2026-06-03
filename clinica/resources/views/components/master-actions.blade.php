@props([
    'record',
    'showRoute',
    'editRoute',
    'destroyRoute',
    'restoreRoute',
])

<div class="space-x-2 whitespace-nowrap flex items-center">
    <a href="{{ $showRoute }}"
        title="Observar"
        style="width: 27px"
       class="btn bg-sky-500 hover:bg-sky-600 border-none btn-xs text-white shadow-sm shadow-sky-500/20 hover:shadow-md hover:shadow-sky-500/40 rounded-md transition-all duration-200 hover:scale-105 active:scale-95">
        <i class="fa-solid fa-eye"></i>
    </a>

    <a href="{{ $editRoute }}"
        style="width: 27px"
       class="btn bg-amber-500 hover:bg-amber-600 border-none btn-xs text-white shadow-sm shadow-amber-500/20 hover:shadow-md hover:shadow-amber-500/40 rounded-md transition-all duration-200 hover:scale-105 active:scale-95"
       title="Editar">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    @if ($record->estado)
        <x-confirm-deactivate
            title="Desactivar"
            :action="$destroyRoute"
            :message="__('The record will be deactivated (logical delete). Historical data will be preserved.')"
        />
    @else
        <form action="{{ $restoreRoute }}" method="POST" class="inline">
            @csrf
            @method('PATCH')
            <button type="submit">
                <span style="width:27px" title="Activar" class="btn bg-purple-600 hover:bg-purple-700 border-none btn-xs text-white shadow-sm shadow-purple-600/20 hover:shadow-md hover:shadow-purple-600/40 rounded-md transition-all duration-200 hover:scale-105 active:scale-95">
                    <i class="fa-solid fa-arrow-turn-up"></i>
                </span>
            </button>
        </form>
    @endif
</div>