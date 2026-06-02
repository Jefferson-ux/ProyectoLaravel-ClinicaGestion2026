<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

@php
    $navItems = [
        ['route' => 'dashboard', 'active' => request()->routeIs('dashboard'), 'label' => __('Dashboard'), 'icon' => 'fa-chart-line'],
        ['route' => 'pacientes.index', 'active' => request()->routeIs('pacientes.*'), 'label' => __('Patients'), 'icon' => 'fa-hospital-user'],
        ['route' => 'doctores.index', 'active' => request()->routeIs('doctores.*'), 'label' => __('Doctors'), 'icon' => 'fa-user-md'],
        ['route' => 'especialidades.index', 'active' => request()->routeIs('especialidades.*'), 'label' => __('Specialties'), 'icon' => 'fa-stethoscope'],
        ['route' => 'citas.index', 'active' => request()->routeIs('citas.index') || request()->routeIs('citas.show') || request()->routeIs('citas.create') || request()->routeIs('citas.edit'), 'label' => __('Appointments'), 'icon' => 'fa-calendar-check'],
        ['route' => 'citas.recetas', 'active' => request()->routeIs('citas.recetas*'), 'label' => __('Prescriptions'), 'icon' => 'fa-file-prescription'],
        ['route' => 'citas.pagos', 'active' => request()->routeIs('citas.pagos*'), 'label' => __('Cash audit'), 'icon' => 'fa-cash-register'],
    ];
@endphp

<div x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    {{-- Barra superior: logo + usuario (sin enlaces CRUD) --}}
    <header class="fixed top-0 left-0 right-0 z-40 h-16 bg-white/90 backdrop-blur-md border-b border-clinic-turquoise-pastel/50 shadow-[var(--shadow-clinic-sm)] lg:left-64">
        <div class="flex h-full items-center justify-between px-4 sm:px-6">
            <div class="flex items-center gap-3">
                {{-- Toggle menú lateral (móvil / tablet) --}}
                <button
                    type="button"
                    @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-clinic-navy bg-clinic-cyan-pastel/40 hover:bg-clinic-turquoise-pastel/60 focus:outline-none focus:ring-2 focus:ring-clinic-accent/40 transition-all duration-200 active:scale-95"
                    :aria-expanded="sidebarOpen"
                    aria-label="{{ __('Menu') }}"
                >
                    <i class="fa-solid fa-bars text-lg" x-show="!sidebarOpen"></i>
                    <i class="fa-solid fa-xmark text-lg" x-show="sidebarOpen" x-cloak></i>
                </button>

                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 group">
                    <img width="100" height="100" src="https://png.pngtree.com/png-clipart/20230307/original/pngtree-medical-logo-vector-png-image_8975261.png" alt="Logo MedaCare">
                    <span class="font-semibold text-base sm:text-lg text-clinic-ink leading-tight hidden sm:inline">
                        Clínica <span class="text-clinic-purple-dark font-bold text-2xl">MedaCare</span>
                    </span>
                </a>
            </div>

            {{-- Usuario (escritorio) --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg text-clinic-muted bg-clinic-mint/50 hover:text-clinic-navy hover:bg-clinic-cyan-pastel/50 focus:outline-none focus:ring-2 focus:ring-clinic-accent/30 transition-all duration-200">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-clinic-cyan-pastel to-clinic-turquoise-pastel text-clinic-navy text-xs font-bold px-4 py-1">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name" class="max-w-[8rem] hidden md:inline"></span>
                            <svg class="fill-current h-4 w-4 text-clinic-muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Usuario compacto (móvil) --}}
            <div class="sm:hidden">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-clinic-cyan-pastel to-clinic-turquoise-pastel text-clinic-navy text-sm font-bold focus:outline-none focus:ring-2 focus:ring-clinic-accent/40">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-clinic-ink" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></p>
                            <p class="text-xs text-clinic-muted truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile')" wire:navigate>{{ __('Profile') }}</x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>{{ __('Log Out') }}</x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </header>

    {{-- Overlay móvil --}}
    <div
        x-show="sidebarOpen"
        x-cloak
        @click="sidebarOpen = false"
        class="clinic-sidebar-backdrop fixed inset-0 z-40 bg-clinic-ink/40 backdrop-blur-sm lg:hidden"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    {{-- Barra lateral izquierda --}}
    <aside
        class="clinic-sidebar fixed top-0 left-0 z-50 flex h-full w-64 flex-col border-r border-clinic-turquoise-pastel/40 bg-gradient-to-b from-white via-clinic-mint/30 to-clinic-cyan-pastel/40 shadow-[var(--shadow-clinic-lg)] lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        <div class="flex h-16 shrink-0 items-center gap-2 border-b border-clinic-turquoise-pastel/50 px-5 lg:px-6">
            <img width="100" height="100" src="https://png.pngtree.com/png-clipart/20230307/original/pngtree-medical-logo-vector-png-image_8975261.png" alt="Logo MedaCare">
            <div>
                <p class="text-sm font-bold text-clinic-ink leading-tight">MedaCare</p>
                <p class="text-[10px] uppercase tracking-wider text-clinic-muted">Panel clínico</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1" @click="if ($event.target.closest('a')) sidebarOpen = false">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-clinic-muted/80">
                {{ __('Navigation') }}
            </p>
            @foreach ($navItems as $item)
                <x-nav-link
                    :href="route($item['route'])"
                    :active="$item['active']"
                    wire:navigate
                >
                    <i class="fa-solid {{ $item['icon'] }} w-5 text-center opacity-80"></i>
                    <span>{{ $item['label'] }}</span>
                </x-nav-link>
            @endforeach
        </nav>

        <div class="shrink-0 border-t border-clinic-turquoise-pastel/50 p-4 hidden lg:block">
            <p class="text-xs text-clinic-muted truncate" title="{{ auth()->user()->email }}">
                <span class="font-medium text-clinic-navy" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></span>
            </p>
        </div>
    </aside>
</div>
