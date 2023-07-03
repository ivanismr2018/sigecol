<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CentroDeSalud;
use DB;

class CentroDeSaludController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        $sql_j = DB::table('jefes')
                ->select('id','entidad')
                ->get();

        $jefes = array();
        foreach($sql_j as $d){
            $jefes[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->entidad));
        }

        $data=[
            'jefes'=>$jefes,
        ];

        return view('nomencladores/centros_salud/home',$data);
    }

    public function listar()
    {
        $datos = DB::table('centro_de_saluds')
                    ->join('jefes', 'centro_de_saluds.jefe_id', '=', 'jefes.id')
                    ->select('centro_de_saluds.id','centro_de_saluds.nombre','jefes.entidad')
                    ->get();
        //$datos = CentroDeSalud::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new CentroDeSalud;
        $d->nombre = e($request->input('nombre'));
        $d->jefe_id = e($request->input('jefe_id'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = CentroDeSalud::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = CentroDeSalud::find($request->input('id'));
        $d->nombre = $request->input('nombre');
        $d->jefe_id = e($request->input('jefe_id'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = CentroDeSalud::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
