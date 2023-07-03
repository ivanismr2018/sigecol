<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;

class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        return view('nomencladores/paises/home');
    }

    public function listar()
    {
        $datos = Pais::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new Pais;
        $d->nombre = e($request->input('nombre'));
        $d->iso = e(strtolower($request->input('iso')));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = Pais::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = Pais::find($request->input('id'));
        $d->nombre = $request->input('nombre');
        $d->iso = e(strtolower($request->input('iso')));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = Pais::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
