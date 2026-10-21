<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ProfesorController extends Controller
{
   private const RULES = [
            'nombre'     => 'required|string|max:100|min:2',
            'apellido'   => 'required|string|max:130|min:3',
            'asignatura' => 'required|string|max:130|min:3',
            'fnac'       => 'nullable|date|before_or_equal:today',
            'genero'     => 'nullable|in:masculino,femenino,otro'
    ];

    private const MESSAGES = [
            
        // Nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser una cadena de texto.',
            'nombre.max'      => 'El nombre no puede tener más de 100 caracteres.',
            'nombre.min'      => 'El nombre debe tener al menos 2 caracteres.',

            // Apellido
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string'   => 'El apellido debe ser una cadena de texto.',
            'apellido.max'      => 'El apellido no puede tener más de 130 caracteres.',
            'apellido.min'      => 'El apellido debe tener al menos 3 caracteres.',

        // Fecha de nacimiento (fnac)
            'fnac.date'            => 'La fecha de nacimiento debe ser una fecha válida.',
            'fnac.before_or_equal' => 'La fecha de nacimiento no puede ser posterior al día de hoy.',

        // Nota de acceso (nacceso)
           'asignatura.required' => 'Los apellidos son obligatorios.',
            'asignatura.string'   => 'Los apellidos deben ser una cadena de texto.',
            'asignatura.max'      => 'Los apellidos no pueden tener más de 130 caracteres.',
            'asignatura.min'      => 'Los apellidos deben tener al menos 3 caracteres.',

        // Género
           'genero.in' => 'El género seleccionado no es válido.',

    ];

    

    public function create(): View {
        //
        return view('profesor.create' , []);
        
    }

    public function destroy(profesor $profesor): RedirectResponse {
        // delete from profesor where id = $profesor->id dd(['destroy' , $profesor]);
        try {
            $profesor->delete();

        } catch (Exception $e){
            return back()->withInput()->withErrors(['error' => 'Error al borrar el profesor',]);

        }

        return redirect()->route('profesor.index')->with(['success' => 'Se ha borrado el profesor']);
        
    }

    public function edit(profesor $profesor): View {
        //
        return view('profesor.edit' , ['profesor' => $profesor]);
        
    }

 
    public function index(): View {
         //
        //$profesors = 'select * from profesor';
        //session()->forget('success');
        $profesors = profesor::all();
        //dd($profesors);
        return view('profesor.index', ['profesors' => $profesors]);
        
    }


    public function show(profesor $profesor): View {
        return view('profesor.show', ['profesor' => $profesor]);
        
    }

    public function store(Request $request): RedirectResponse {
        //1º Validar
        $validator = Validator::make($request->all(), self::RULES , self::MESSAGES);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $profesor = new profesor($request->all());
        try {
             $profesor->save();
        } catch (UniqueConstraintViolationException $e){
            return back()->withInput()->withErrors([
                'error' => 'Clave unica duplicada',
                //'nombre'     => 'Este campo forma parte de la clave única',
                //'apellidos'  => 'Este campo también forma parte de la clave única',
                
                ]);

        } catch (Exception $e){
            echo('global');
            dd($e);

        }
        // session(['success'  => 'Se ha creado el profesor correctamente. V2']);
        return redirect()->route('profesor.index')->with(['success' => 'Se ha creado el profesor correctamente']);
        
    }

    public function update(Request $request, profesor $profesor): RedirectResponse {
        $validator = Validator::make($request->all(), self::RULES , self::MESSAGES);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        // actualizar el profesor 
        try {
             $profesor->update($request->all()); 
        } catch (UniqueConstraintViolationException $e){
            return back()->withInput()->withErrors(['error' => 'Clave unica duplicada',]);
        } catch (Exception $e){
            return back()->withInput()->withErrors(['error' => 'Error al editar el profesor',]);
        
        }
    return redirect()->route('profesor.index');
        
    }

}
