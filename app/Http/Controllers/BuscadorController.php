<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BuscadorController extends Controller
{
    public function centroLaboral(REQUEST $request)
    {
        $parametro = $request->input('searchTerm');

        $datos = DB::table('centro_de_saluds')
                ->select('id','nombre')
                ->where('nombre', 'like', '%'.$parametro.'%')
                ->get();

        $data = array();
            foreach($datos as $d){
                $data[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->nombre));
        }
        return $data;
    }

    public function municipios(REQUEST $request)
    {
        $parametro = $request->input('searchTerm');

        $datos = DB::table('municipios')
                ->select('municipios.id','municipios.nombre as municipio', 'provincias.nombre as provincia')
                ->join('provincias', 'municipios.prov_id', '=', 'provincias.id')
                ->where('municipios.nombre', 'like', '%'.$parametro.'%')
                ->get();

        $data = array();
            foreach($datos as $d){
                $data[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->provincia." - ".$d->municipio));
        }
        return $data;
    }

    public function especialidades(REQUEST $request)
    {
        $parametro = $request->input('searchTerm');

        $datos = DB::table('especialidads')
                ->select('id','nombre')
                ->where('nombre', 'like', '%'.$parametro.'%')
                ->get();

        $data = array();
            foreach($datos as $d){
                $data[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->nombre));
        }
        return $data;
    }
}
