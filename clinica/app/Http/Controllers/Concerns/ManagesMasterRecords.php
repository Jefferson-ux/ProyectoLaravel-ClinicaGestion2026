<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait ManagesMasterRecords
{
    protected function applyActiveFilter(Builder $query, Request $request): Builder
    {
        if (! $request->boolean('ver_inactivos')) {
            $query->where('estado', 1);
        }

        return $query;
    }

    protected function deactivateRecord(object $record, string $routeName, string $label): RedirectResponse
    {
        if (! $record->estado) {
            return redirect()
                ->route($routeName, ['ver_inactivos' => 1])
                ->with('success', __('The :label is already inactive. Use Activate to restore it.', ['label' => $label]));
        }

        $record->update(['estado' => 0]);

        return redirect()
            ->route($routeName)
            ->with('success', __(':label deactivated successfully.', ['label' => $label]));
    }

    protected function restoreRecord(object $record, string $routeName, string $label): RedirectResponse
    {
        $record->update(['estado' => 1]);

        return redirect()
            ->route($routeName, ['ver_inactivos' => 1])
            ->with('success', __(':label reactivated successfully.', ['label' => $label]));
    }
}
