<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('alumno.create', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno):RedirectResponse
    {
        //
        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno):View
    {
        return view('index', []);
    }

    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $alumnos = Alumno::all();
        dd($alumno);
        return view('index', ['alumnos'=>$alumnos]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno):View
    {
        return view('index', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $alumno = new Alumno($request -> all());
        $alumno ->nombre= $request ->nombre;
        $alumno ->apellido= $request ->apellido;
        $alumno ->genero= $request ->genero;
        $alumno ->fnac= $request ->fnac;
        $alumno ->nacceso= $request ->nacceso;
        //return redirect()->route('index');
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumno $alumno):RedirectResponse
    {
        //
        return redirect()->route('index');
    }


}
