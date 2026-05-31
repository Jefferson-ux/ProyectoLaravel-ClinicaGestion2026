<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CitasController extends Controller
{
    public function index(): View
    {
        $citas = Cita::with(['paciente', 'doctor.especialidad', 'recetas', 'pagos'])
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
        ]);

        $validated['estado'] = 'PENDIENTE';

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
        ])->findOrFail($id);

        return view('citas.show', compact('cita'));
    }

    public function edit(string $id): View
    {
        $cita = Cita::with(['recetas', 'pagos'])->findOrFail($id);

        $pacientes = Paciente::where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $doctores = Doctor::with('especialidad')
            ->where('estado', 1)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $receta = $cita->recetas->first();
        $pago = $cita->pagos->first();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores', 'receta', 'pago'));
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
            'estado' => 'required|in:PENDIENTE,ATENDIDO,CANCELADO',
            'descripcion' => 'required_if:estado,ATENDIDO|nullable|string',
            'medicamentos' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'monto' => 'required_if:estado,ATENDIDO|nullable|numeric|min:0',
            'fecha_pago' => 'nullable|date',
            'metodo_pago' => 'nullable|string|max:50',
        ]);

        DB::transaction(function () use ($cita, $validated, $request): void {
            $cita->update([
                'id_paciente' => $validated['id_paciente'],
                'id_doctor' => $validated['id_doctor'],
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'motivo' => $validated['motivo'] ?? null,
                'estado' => $validated['estado'],
            ]);

            if ($validated['estado'] === 'ATENDIDO') {
                DB::table('recetas')->updateOrInsert(
                    ['id_cita' => $cita->id],
                    [
                        'descripcion' => $request->input('descripcion'),
                        'medicamentos' => $request->input('medicamentos'),
                        'recomendaciones' => $request->input('recomendaciones'),
                    ]
                );

                DB::table('pagos')->updateOrInsert(
                    ['id_cita' => $cita->id],
                    [
                        'monto' => $request->input('monto'),
                        'fecha_pago' => $request->input('fecha_pago', now()->toDateString()),
                        'metodo_pago' => $request->input('metodo_pago'),
                        'estado' => 'PAGADO',
                    ]
                );
            }

            if ($validated['estado'] === 'CANCELADO') {
                DB::table('pagos')
                    ->where('id_cita', $cita->id)
                    ->update(['estado' => 'ANULADO']);
            }
        });

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $cita = Cita::findOrFail($id);

        if ($cita->estado === 'CANCELADO') {
            return redirect()
                ->route('citas.index')
                ->with('success', __('The appointment is already cancelled.'));
        }

        DB::transaction(function () use ($cita): void {
            $cita->update(['estado' => 'CANCELADO']);

            DB::table('pagos')
                ->where('id_cita', $cita->id)
                ->update(['estado' => 'ANULADO']);
        });

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita cancelada correctamente.');
    }

    public function recetas(): View
    {
        $recetas = DB::table('recetas')
            ->join('citas', 'recetas.id_cita', '=', 'citas.id')
            ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id')
            ->join('doctores', 'citas.id_doctor', '=', 'doctores.id')
            ->select(
                'recetas.id',
                'recetas.id_cita',
                'recetas.descripcion',
                'recetas.medicamentos',
                'recetas.recomendaciones',
                'citas.fecha',
                'citas.hora',
                'citas.estado as cita_estado',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'doctores.nombres as doctor_nombres',
                'doctores.apellidos as doctor_apellidos',
            )
            ->orderBy('recetas.id')
            ->get();

        return view('citas.recetas', compact('recetas'));
    }

    public function editReceta(string $id): View
    {
        $receta = DB::table('recetas')
            ->join('citas', 'recetas.id_cita', '=', 'citas.id')
            ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id')
            ->join('doctores', 'citas.id_doctor', '=', 'doctores.id')
            ->select(
                'recetas.*',
                'citas.fecha',
                'citas.hora',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'doctores.nombres as doctor_nombres',
                'doctores.apellidos as doctor_apellidos',
            )
            ->where('recetas.id', $id)
            ->first();

        if (! $receta) {
            abort(404);
        }

        return view('citas.receta-edit', compact('receta'));
    }

    public function updateReceta(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'descripcion' => 'nullable|string',
            'medicamentos' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        $updated = DB::table('recetas')->where('id', $id)->update($validated);

        if (! $updated) {
            return redirect()
                ->route('citas.recetas')
                ->with('error', __('Prescription not found.'));
        }

        return redirect()
            ->route('citas.recetas')
            ->with('success', 'Receta actualizada correctamente.');
    }

    public function pagos(): View
    {
        $pagos = DB::table('pagos')
            ->join('citas', 'pagos.id_cita', '=', 'citas.id')
            ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id')
            ->join('doctores', 'citas.id_doctor', '=', 'doctores.id')
            ->select(
                'pagos.id',
                'pagos.id_cita',
                'pagos.monto',
                'pagos.fecha_pago',
                'pagos.metodo_pago',
                'pagos.estado',
                'citas.fecha',
                'citas.hora',
                'pacientes.nombres as paciente_nombres',
                'pacientes.apellidos as paciente_apellidos',
                'doctores.nombres as doctor_nombres',
                'doctores.apellidos as doctor_apellidos',
            )
            ->orderBy('pagos.id')
            ->get();

        return view('citas.pagos', compact('pagos'));
    }

    public function anularPago(string $id): RedirectResponse
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, __('Only administrators can void payments.'));
        }

        $pago = DB::table('pagos')->where('id', $id)->first();

        if (! $pago) {
            return redirect()
                ->route('citas.pagos')
                ->with('error', __('Payment not found.'));
        }

        if ($pago->estado === 'ANULADO') {
            return redirect()
                ->route('citas.pagos')
                ->with('success', __('The payment is already voided.'));
        }

        DB::table('pagos')->where('id', $id)->update(['estado' => 'ANULADO']);

        return redirect()
            ->route('citas.pagos')
            ->with('success', 'Pago anulado correctamente.');
    }
}
