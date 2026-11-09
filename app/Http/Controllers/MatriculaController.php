<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Modulo;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    private const MESSAGES = [
        'alumno_id.required' => 'El alumno es obligatorio',
        'alumno_id.numeric' => 'El modulo no se ha seleccionado bien',
        'alumno.exists' => 'El alumno no existe',
        'modulo_id.required' => 'El modulo es obligatorio',
        'modulo_id.numeric' => 'El modulo no se ha seleccionado bien',
        'modulo.exists' => 'El modulo no existe',
    ];

    private const RULES = [
        'alumno_id' => 'required|numeric|exists:alumno,id',
        'modulo_id' => 'required|numeric|exists:modulo,id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matriculas = Matricula::all();

        // $matriculas= Matricula::orderBy('alfabeticamente')->get();
        return view('matricula.index', [
            'matriculas' => $matriculas,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('matricula.create', [
            'alumnos' => Alumno::orderBy('apellidos')->orderBy('nombre')->get(),
            'curso_escolar' => $this->getCursoEscolar(),
            'modulos' => Modulo::pluck('nombre', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $matricula = new Matricula($request->all());
        $matricula->curso = $this->getCurso();
        try {
            $matricula->save();

            // return redirect()->route('matricula.create')->with(['success' => 'Se ha matriculado el alumno correctamente']);
            return back()->with(['success' => 'Se ha matriculado correctamente']);
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'El alumno ya está matriculado en este módulo para el curso actual.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al matricular.',
            ]);
        }
    }

    public function storeModules(Request $request): RedirectResponse
    {
        $curso = $this->getCurso();
        $alumno_id = $request->alumno_id;
        $modulos_id = $request->input('modulos', $request->input('modulo_id', []));
        if (!is_array($modulos_id)) {
            $modulos_id = $modulos_id ? (array)$modulos_id : [];
        }

        if (empty($modulos_id)) {
            $registrosBorrados = Matricula::where('alumno_id', $alumno_id)->where('curso', $curso)->delete();
        } else {
            $registrosBorrados = Matricula::where('alumno_id', $alumno_id)->where('curso', $curso)->whereNotIn('modulo_id', $modulos_id)->delete();
        }

        $contador = 0;
        foreach ($modulos_id as $moduloId) {
            $contador += Matricula::insertOrIgnore([
                'alumno_id' => $alumno_id,
                'modulo_id' => $moduloId,
                'curso' => $curso,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with(['success' => "Se ha matriculado correctamente. Se han insertado $contador matrículas y se han borrado $registrosBorrados matrículas."]);
    }

    public function storeAlumnos(Request $request, ?Modulo $modulo = null): RedirectResponse
    {
        $curso = $this->getCurso();
        $modulo_id = $modulo?->id ?? $request->modulo_id;
        $alumnos_id = $request->input('alumnos', $request->input('alumno_id', []));
        if (!is_array($alumnos_id)) {
            $alumnos_id = $alumnos_id ? (array)$alumnos_id : [];
        }

        if (empty($alumnos_id)) {
            $registrosBorrados = Matricula::where('modulo_id', $modulo_id)->where('curso', $curso)->delete();
        } else {
            $registrosBorrados = Matricula::where('modulo_id', $modulo_id)->where('curso', $curso)->whereNotIn('alumno_id', $alumnos_id)->delete();
        }

        $contador = 0;
        foreach ($alumnos_id as $alumnoId) {
            $contador += Matricula::insertOrIgnore([
                'alumno_id' => $alumnoId,
                'modulo_id' => $modulo_id,
                'curso' => $curso,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with(['success' => "Se ha matriculado correctamente. Se han insertado $contador matrículas y se han borrado $registrosBorrados matrículas."]);
    }

        

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        //
    }

    public function make(Request $request,Alumno $alumno):RedirectResponse{
        // $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);
        /*if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }*/
        $matricula = new Matricula($request->all());
        $matricula->curso = $this->getCurso();
        $matricula->alumno_id = $alumno->id;
        try {
            $matricula->save();
            return back()->with(['success' => 'Se ha matriculado correctamente']);
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'El alumno ya está matriculado en este módulo para el curso actual.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al matricular.',
            ]);
        }

    }
}
