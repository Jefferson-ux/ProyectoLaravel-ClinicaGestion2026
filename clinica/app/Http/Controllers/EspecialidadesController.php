<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ManagesMasterRecords;
use App\Models\Especialidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EspecialidadesController extends Controller
{
    use ManagesMasterRecords;

    public function index(Request $request): View
    {
        $especialidades = $this->applyActiveFilter(
            Especialidad::withCount('doctores'),
            $request
        )
            ->orderBy('id')
            ->get();

        return view('especialidades.index', [
            'especialidades' => $especialidades,
            'verInactivos' => $request->boolean('ver_inactivos'),
        ]);
    }

    public function create(): View
    {
        return view('especialidades.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        Especialidad::create($validated);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad registrada correctamente.');
    }

    public function show(string $id): View
    {
        $especialidad = Especialidad::with(['doctores' => fn ($query) => $query->orderBy('id')])
            ->findOrFail($id);

        return view('especialidades.show', compact('especialidad'));
    }

    public function edit(string $id): View
    {
        $especialidad = Especialidad::findOrFail($id);

        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $especialidad = Especialidad::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre,'.$especialidad->id,
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        $especialidad->update($validated);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $especialidad = Especialidad::findOrFail($id);

        return $this->deactivateRecord($especialidad, 'especialidades.index', __('specialty'));
    }

    public function restore(string $id): RedirectResponse
    {
        $especialidad = Especialidad::findOrFail($id);

        return $this->restoreRecord($especialidad, 'especialidades.index', __('specialty'));
    }
}
