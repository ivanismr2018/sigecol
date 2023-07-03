<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use DB;
use App\Colaborador;
use App\Mision;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    function paises() {

        $paises_con_mision = DB::table('misions as m')
                                ->select('m.pais as idpais','p.nombre')
                                ->join('pais as p','m.pais','=','p.id')
                                ->distinct()
                                ->where('m.estado','=','0')
                                ->get();

        $consulta = DB::table('colaboradores as c')
                        ->select('e.nombre as especialidad','cs.nombre as centro_salud','c.nombre','c.apellidos','m.tipo_mision as tipo','mm.nombre as municipio','p.id as idpais','p.nombre as pais')
                        ->join('misions as m','m.colaborador_id','=','c.id')
                        ->join('pais as p','m.pais','=','p.id')
                        ->join('municipios as mm','c.municipio','=','mm.id')
                        ->join('centro_de_saluds as cs','cs.id','=','c.centro')
                        ->join('especialidads as e','e.id','=','c.especialidad')
                        ->where('m.estado','=','0')
                        ->get();

        $data = [
            'paises'=>$paises_con_mision,
            'datos'=>$consulta
        ];

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('reporte/paises',$data));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }


}
