<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\support\Facades\DB;

class pagesController extends Controller
{
    //
    public function inicio()
    {
        return view('welcome');
    }

    public function alumno()
    {
        $tablaalumnos = Alumno::all();
        $total = Alumno::all()->count();
        if ($total > 1) {
            return view('alumno_vista', compact('tablaalumnos', 'total'));
        } else {
            return view('welcome');
        }
    }

    public function profesor()
    {
        $tablaprofesors = Profesor::all();
        $sumaexp = DB::table('profesors')->sum('experiencia');
        return view('profesor_vista', compact('tablaprofesors', 'sumaexp'));
    }

    public function intro()
    {
        return view('intro_vista');
    }

    public function guardar(Request $request)
    {
        $alumno = new Alumno;
        $alumno->nombre = $request->input("nombre");
        $alumno->apellidos = $request->input("apellidos");
        $alumno->idProfesor = $request->input("idProfesor");
        $alumno->save();
        $tablaalumnos = Alumno::all();
        $total = Alumno::all()->count();
        return view('alumno_vista', compact('tablaalumnos', 'total'));
    }

    public function anadirnota(Request $request)
    {
        switch ($request->input('accion')) {
            case 'enviar':
                $id = $request->input("id");
                $nota = $request->input("nota");
                DB::table('alumnos')->where('id', $id)->update(['nota' => $nota]);
                $tablaalumnos = Alumno::all();
                $total = Alumno::all()->count();
                return view('alumno_vista', compact('tablaalumnos', 'total'));
                break;
            case 'oficial':
                // Marca a true el campo oficial y mostrar las vista de publicada
                $id = $request->input("id");
                $affected = DB::table('alumnos')->where('id', $id)->update(['oficial' => 1]);
                $tablapublicada = DB::table('alumnos')->join('profesors', 'profesors.id', 'alumnos.idProfesor')->select('alumnos.*', 'profesors.nombre')->where('oficial', 1)->get();
                return view('publicada_vista', compact('tablapublicada'));
                break;
        }
    }

    public function publicar()
    {
        // Mostrar datos con un INNER JOIN
        $tablapublicada = DB::table('alumnos')->join('profesors', 'profesors.id', 'alumnos.idProfesor')->select('alumnos.*', 'profesors.nombre as ProfeNombre')->where('oficial', 1)->get();
        return view('publicada_vista', compact('tablapublicada'));
    }
}
