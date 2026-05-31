<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctoresController extends Controller
{
    public function index(): View
    {
        $doctores = Doctor::with('especialidad')
            ->orderBy('id')
            ->get();

        return view('doctores.index', compact('doctores'));
    }

    public function create(): View
    {
        $especialidades = Especialidad::where('estado', 1)
            ->orderBy('nombre')
            ->get();

        return view('doctores.create', compact('especialidades'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dni' => 'required|string|size:8|unique:doctores,dni',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:100|unique:doctores,correo',
            'id_especialidad' => 'nullable|exists:especialidades,id',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        Doctor::create($validated);

        return redirect()
            ->route('doctores.index')
            ->with('success', 'Doctor registrado correctamente.');
    }

    public function show(string $id): View
    {
        $doctor = Doctor::with(['especialidad', 'citas' => fn ($query) => $query->orderBy('id'), 'citas.paciente'])
            ->findOrFail($id);

        return view('doctores.show', compact('doctor'));
    }

    public function edit(string $id): View
    {
        $doctor = Doctor::findOrFail($id);

        $especialidades = Especialidad::where('estado', 1)
            ->orderBy('nombre')
            ->get();

        return view('doctores.edit', compact('doctor', 'especialidades'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|size:8|unique:doctores,dni,'.$doctor->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:100|unique:doctores,correo,'.$doctor->id,
            'id_especialidad' => 'nullable|exists:especialidades,id',
            'estado' => 'nullable|boolean',
        ]);

        $validated['estado'] = $request->boolean('estado', true);

        $doctor->update($validated);

        return redirect()
            ->route('doctores.index')
            ->with('success', 'Doctor actualizado correctamente.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()
            ->route('doctores.index')
            ->with('success', 'Doctor eliminado correctamente.');
    }
}
