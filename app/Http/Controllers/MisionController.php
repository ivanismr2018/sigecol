<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colaborador;
use App\Mision;
use DB;

class MisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function poblar() {
        for ($i=0; $i < 270; $i++) {
            $d = new Mision;
            $d->colaborador_id = rand(1,200);
            $d->fecha_salida = mt_rand(2014,2023)."-".mt_rand(1,12)."-".mt_rand(1,28);
            $d->tipo_mision = ucfirst($this->generateRandomString());
            $d->pais = rand(1,240);
            $d->fecha_regreso = mt_rand(2014,2023)."-".mt_rand(1,12)."-".mt_rand(1,28);
            $d->estado = rand(0,1);
            $d->save();
        }
    }

    function generateRandomString() {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateRandomNumero() {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 11; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function index($id)
    {
        $sql_p = DB::table('pais')
                ->select('id','nombre')
                ->get();

        $paises = array();
        foreach($sql_p as $d){
            $paises[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->nombre));
        }

        $datos = DB::table('colaboradores')
                    ->select('colaboradores.nombre as nombre','colaboradores.apellidos','centro_de_saluds.nombre as centro','municipios.nombre as municipio','especialidads.nombre as especialidad')
                    ->join('centro_de_saluds', 'colaboradores.centro', '=', 'centro_de_saluds.id')
                    ->join('municipios', 'colaboradores.municipio', '=', 'municipios.id')
                    ->join('especialidads', 'colaboradores.especialidad', '=', 'especialidads.id')
                    ->join('misions', 'colaboradores.id', '=', 'misions.colaborador_id')
                    ->get();

        $data=[
            'paises'=>$paises,
            'colaborador'=> $id,
            'datos'=>$datos,
        ];

        return view('misiones/home',$data);
    }

    public function listar(REQUEST $request)
    {
        $id = $request->input('id');
        $datos = DB::table('misions')
                    ->join('pais', 'misions.pais', '=', 'pais.id')
                    ->join('colaboradores', 'misions.colaborador_id', '=', 'colaboradores.id')
                    ->select('misions.*','pais.nombre as nombre_pais')
                    ->where('misions.colaborador_id',$id)
                    ->get();
        //$datos = Colaborador::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new Mision;
        $d->colaborador_id = e($request->input('colaborador'));
        $d->fecha_salida = e($request->input('fecha_salida'));
        $d->tipo_mision = e($request->input('tipo_mision'));
        $d->pais = e($request->input('pais'));
        $d->fecha_regreso = e($request->input('fecha_regreso'));
        $d->estado = e($request->input('estado'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = Mision::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = Mision::find($request->input('id'));
        $d->fecha_salida = e($request->input('fecha_salida'));
        $d->tipo_mision = e($request->input('tipo_mision'));
        $d->pais = e($request->input('pais'));
        $d->fecha_regreso = e($request->input('fecha_regreso'));
        $d->estado = e($request->input('estado'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = Mision::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
