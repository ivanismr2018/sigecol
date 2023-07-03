<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        return view('nomencladores/especialidades/home');
    }

    public function listar()
    {
        $datos = Especialidad::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new Especialidad;
        $d->nombre = e($request->input('nombre'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = Especialidad::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = Especialidad::find($request->input('id'));
        $d->nombre = $request->input('nombre');

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = Especialidad::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
