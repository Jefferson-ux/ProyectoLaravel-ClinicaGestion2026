<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EspecialidadesController extends Controller
{
    public function index(): View
    {
        $especialidades = Especialidad::withCount('doctores')
            ->orderBy('id')
            ->get();

        return view('especialidades.index', compact('especialidades'));
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
        $especialidad->delete();

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad eliminada correctamente.');
    }
}
