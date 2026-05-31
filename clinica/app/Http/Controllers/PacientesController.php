<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ManagesMasterRecords;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PacientesController extends Controller
{
    use ManagesMasterRecords;

    public function index(Request $request): View
    {
        $pacientes = $this->applyActiveFilter(
            Paciente::withCount('citas'),
            $request
        )
            ->orderBy('id')
            ->get();

        return view('pacientes.index', [
            'pacientes' => $pacientes,
            'verInactivos' => $request->boolean('ver_inactivos'),
        ]);
    }

    public function create(): View
    {
        return view('pacientes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dni' => 'required|string|size:8|unique:pacientes,dni',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:100',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        Paciente::create($validated);

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    public function show(string $id): View
    {
        $paciente = Paciente::with(['citas' => fn ($query) => $query->orderBy('id'), 'citas.doctor.especialidad'])
            ->findOrFail($id);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit(string $id): View
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|size:8|unique:pacientes,dni,'.$paciente->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:100',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        $paciente->update($validated);

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $paciente = Paciente::findOrFail($id);

        return $this->deactivateRecord($paciente, 'pacientes.index', __('patient'));
    }

    public function restore(string $id): RedirectResponse
    {
        $paciente = Paciente::findOrFail($id);

        return $this->restoreRecord($paciente, 'pacientes.index', __('patient'));
    }
}
