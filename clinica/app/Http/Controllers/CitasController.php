<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitasController extends Controller
{
    public function index(): View
    {
        $citas = Cita::with(['paciente', 'doctor.especialidad'])
            ->orderBy('id')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create(): View
    {
        $pacientes = Paciente::where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $doctores = Doctor::with('especialidad')
            ->where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        return view('citas.create', compact('pacientes', 'doctores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id',
            'id_doctor' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:20',
        ]);

        $validated['estado'] = $validated['estado'] ?? 'PENDIENTE';

        Cita::create($validated);

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita registrada correctamente.');
    }

    public function show(string $id): View
    {
        $cita = Cita::with([
            'paciente',
            'doctor.especialidad',
            'recetas' => fn ($query) => $query->orderBy('id'),
            'pagos' => fn ($query) => $query->orderBy('id'),
        ])
            ->findOrFail($id);

        return view('citas.show', compact('cita'));
    }

    public function edit(string $id): View
    {
        $cita = Cita::with(['paciente', 'doctor.especialidad'])
            ->findOrFail($id);

        $pacientes = Paciente::where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $doctores = Doctor::with('especialidad')
            ->where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $cita = Cita::findOrFail($id);

        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id',
            'id_doctor' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:20',
        ]);

        $cita->update($validated);

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita eliminada correctamente.');
    }

    public function storeReceta(Request $request, string $id): RedirectResponse
    {
        $cita = Cita::findOrFail($id);

        $validated = $request->validate([
            'descripcion' => 'nullable|string',
            'medicamentos' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        $cita->recetas()->create($validated);

        return redirect()
            ->route('citas.show', $cita->id)
            ->with('success', 'Receta registrada correctamente.');
    }

    public function storePago(Request $request, string $id): RedirectResponse
    {
        $cita = Cita::findOrFail($id);

        $validated = $request->validate([
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'nullable|date',
            'metodo_pago' => 'nullable|string|max:50',
            'estado' => 'nullable|string|max:20',
        ]);

        $validated['estado'] = $validated['estado'] ?? 'PAGADO';

        $cita->pagos()->create($validated);

        return redirect()
            ->route('citas.show', $cita->id)
            ->with('success', 'Pago registrado correctamente.');
    }
}
