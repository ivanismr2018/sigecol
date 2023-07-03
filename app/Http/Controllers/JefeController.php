<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jefe;

class JefeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        return view('nomencladores/jefes/home');
    }

    public function listar()
    {
        $datos = Jefe::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new Jefe;
        $d->entidad = e($request->input('jefe'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = Jefe::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = Jefe::find($request->input('id'));
        $d->entidad = $request->input('jefe');

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = Jefe::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
