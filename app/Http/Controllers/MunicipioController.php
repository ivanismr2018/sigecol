<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use DB;

class MunicipioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        $sql_p = DB::table('provincias')
                ->select('id','nombre')
                ->get();

        $provincias = array();
        foreach($sql_p as $d){
            $provincias[] = array("id"=>$d->id, "text"=>htmlspecialchars_decode($d->nombre));
        }

        $data=[
            'provincias'=>$provincias,
        ];

        return view('nomencladores/municipios/home',$data);
    }

    // public function insertmasivo()
    // {
    //     DB::table('provincias')->insertOrIgnore([
    //         ['nombre' => 'Pinar del Río'],
    //         ['nombre' => 'Artemisa'],
    //         ['nombre' => 'Mayabeque'],
    //         ['nombre' => 'La Habana'],
    //         ['nombre' => 'Matanzas'],
    //         ['nombre' => 'Cienfuegos'],
    //         ['nombre' => 'Villa Clara'],
    //         ['nombre' => 'Sancti Spíritus'],
    //         ['nombre' => 'Ciego de Ávila'],
    //         ['nombre' => 'Camagüey'],
    //         ['nombre' => 'Las Tunas'],
    //         ['nombre' => 'Holguín'],
    //         ['nombre' => 'Santiago de Cuba'],
    //         ['nombre' => 'Guantánamo'],
    //         ['nombre' => 'Isla de la Juventud'],
    //         ['nombre' => 'Granma'],
    //     ]);

    //     DB::table('municipios')->insertOrIgnore([
    //         ['prov_id' => 1, 'nombre' => 'Consolación del Sur'],
    //         ['prov_id' => 1, 'nombre' => 'Guane'],
    //         ['prov_id' => 1, 'nombre' => 'La Palma'],
    //         ['prov_id' => 1, 'nombre' => 'Los Palacios'],
    //         ['prov_id' => 1, 'nombre' => 'Mantua'],
    //         ['prov_id' => 1, 'nombre' => 'Minas de Matahambre'],
    //         ['prov_id' => 1, 'nombre' => 'Pinar del Río'],
    //         ['prov_id' => 1, 'nombre' => 'San Juan y Martínez'],
    //         ['prov_id' => 1, 'nombre' => 'San Luis'],
    //         ['prov_id' => 1, 'nombre' => 'Sandino'],
    //         ['prov_id' => 1, 'nombre' => 'Viñales'],
    //         ['prov_id' => 2, 'nombre' => 'Alquízar'],
    //         ['prov_id' => 2, 'nombre' => 'Artemisa'],
    //         ['prov_id' => 2, 'nombre' => 'Bauta'],
    //         ['prov_id' => 2, 'nombre' => 'Caimito'],
    //         ['prov_id' => 2, 'nombre' => 'Guanajay'],
    //         ['prov_id' => 2, 'nombre' => 'Güira de Melena'],
    //         ['prov_id' => 2, 'nombre' => 'Mariel'],
    //         ['prov_id' => 2, 'nombre' => 'San Antonio de los Baños'],
    //         ['prov_id' => 2, 'nombre' => 'Bahía Honda'],
    //         ['prov_id' => 2, 'nombre' => 'San Cristóbal'],
    //         ['prov_id' => 2, 'nombre' => 'Candelaria'],
    //         ['prov_id' => 3, 'nombre' => 'Batabanó'],
    //         ['prov_id' => 3, 'nombre' => 'Bejucal'],
    //         ['prov_id' => 3, 'nombre' => 'Güines'],
    //         ['prov_id' => 3, 'nombre' => 'Jaruco'],
    //         ['prov_id' => 3, 'nombre' => 'Madruga'],
    //         ['prov_id' => 3, 'nombre' => 'Melena del Sur'],
    //         ['prov_id' => 3, 'nombre' => 'Nueva Paz'],
    //         ['prov_id' => 3, 'nombre' => 'Quivicán'],
    //         ['prov_id' => 3, 'nombre' => 'San José de las Lajas'],
    //         ['prov_id' => 3, 'nombre' => 'San Nicolás de Bari'],
    //         ['prov_id' => 3, 'nombre' => 'Santa Cruz del Norte'],
    //         ['prov_id' => 4, 'nombre' => 'Arroyo Naranjo'],
    //         ['prov_id' => 4, 'nombre' => 'Boyeros'],
    //         ['prov_id' => 4, 'nombre' => 'Centro Habana'],
    //         ['prov_id' => 4, 'nombre' => 'Cerro'],
    //         ['prov_id' => 4, 'nombre' => 'Cotorro'],
    //         ['prov_id' => 4, 'nombre' => 'Diez de Octubre'],
    //         ['prov_id' => 4, 'nombre' => 'Guanabacoa'],
    //         ['prov_id' => 4, 'nombre' => 'Habana del Este'],
    //         ['prov_id' => 4, 'nombre' => 'Habana Vieja'],
    //         ['prov_id' => 4, 'nombre' => 'La Lisa'],
    //         ['prov_id' => 4, 'nombre' => 'Marianao'],
    //         ['prov_id' => 4, 'nombre' => 'Playa'],
    //         ['prov_id' => 4, 'nombre' => 'Plaza'],
    //         ['prov_id' => 4, 'nombre' => 'Regla'],
    //         ['prov_id' => 4, 'nombre' => 'San Miguel del Padrón'],
    //         ['prov_id' => 5, 'nombre' => 'Calimete'],
    //         ['prov_id' => 5, 'nombre' => 'Cárdenas'],
    //         ['prov_id' => 5, 'nombre' => 'Ciénaga de Zapata'],
    //         ['prov_id' => 5, 'nombre' => 'Colón'],
    //         ['prov_id' => 5, 'nombre' => 'Jagüey Grande'],
    //         ['prov_id' => 5, 'nombre' => 'Jovellanos'],
    //         ['prov_id' => 5, 'nombre' => 'Limonar'],
    //         ['prov_id' => 5, 'nombre' => 'Los Arabos'],
    //         ['prov_id' => 5, 'nombre' => 'Martí'],
    //         ['prov_id' => 5, 'nombre' => 'Matanzas'],
    //         ['prov_id' => 5, 'nombre' => 'Pedro Betancourt'],
    //         ['prov_id' => 5, 'nombre' => 'Perico'],
    //         ['prov_id' => 5, 'nombre' => 'Unión de Reyes'],
    //         ['prov_id' => 6, 'nombre' => 'Abreus'],
    //         ['prov_id' => 6, 'nombre' => 'Aguada de Pasajeros'],
    //         ['prov_id' => 6, 'nombre' => 'Cienfuegos'],
    //         ['prov_id' => 6, 'nombre' => 'Cruces'],
    //         ['prov_id' => 6, 'nombre' => 'Cumanayagua'],
    //         ['prov_id' => 6, 'nombre' => 'Palmira'],
    //         ['prov_id' => 6, 'nombre' => 'Rodas'],
    //         ['prov_id' => 6, 'nombre' => 'Santa Isabel de las Lajas'],
    //         ['prov_id' => 7, 'nombre' => 'Caibarién'],
    //         ['prov_id' => 7, 'nombre' => 'Camajuaní'],
    //         ['prov_id' => 7, 'nombre' => 'Cifuentes'],
    //         ['prov_id' => 7, 'nombre' => 'Corralillo'],
    //         ['prov_id' => 7, 'nombre' => 'Encrucijada'],
    //         ['prov_id' => 7, 'nombre' => 'Manicaragua'],
    //         ['prov_id' => 7, 'nombre' => 'Placetas'],
    //         ['prov_id' => 7, 'nombre' => 'Quemado de Güines'],
    //         ['prov_id' => 7, 'nombre' => 'Ranchuelo'],
    //         ['prov_id' => 7, 'nombre' => 'Remedios'],
    //         ['prov_id' => 7, 'nombre' => 'Sagua la Grande'],
    //         ['prov_id' => 7, 'nombre' => 'Santa Clara'],
    //         ['prov_id' => 7, 'nombre' => 'Santo Domingo'],
    //         ['prov_id' => 8, 'nombre' => 'Cabaigúan'],
    //         ['prov_id' => 8, 'nombre' => 'Fomento'],
    //         ['prov_id' => 8, 'nombre' => 'Jatibonico'],
    //         ['prov_id' => 8, 'nombre' => 'La Sierpe'],
    //         ['prov_id' => 8, 'nombre' => 'Sancti Spíritus'],
    //         ['prov_id' => 8, 'nombre' => 'Taguasco'],
    //         ['prov_id' => 8, 'nombre' => 'Trinidad'],
    //         ['prov_id' => 8, 'nombre' => 'Yaguajay'],
    //         ['prov_id' => 9, 'nombre' => 'Ciro Redondo'],
    //         ['prov_id' => 9, 'nombre' => 'Baraguá'],
    //         ['prov_id' => 9, 'nombre' => 'Bolivia'],
    //         ['prov_id' => 9, 'nombre' => 'Chambas'],
    //         ['prov_id' => 9, 'nombre' => 'Ciego de Ávila'],
    //         ['prov_id' => 9, 'nombre' => 'Florencia'],
    //         ['prov_id' => 9, 'nombre' => 'Majagua'],
    //         ['prov_id' => 9, 'nombre' => 'Morón'],
    //         ['prov_id' => 9, 'nombre' => 'Primero de Enero'],
    //         ['prov_id' => 9, 'nombre' => 'Venezuela'],
    //         ['prov_id' => 10, 'nombre' => 'Camagüey'],
    //         ['prov_id' => 10, 'nombre' => 'Carlos Manuel de Céspedes'],
    //         ['prov_id' => 10, 'nombre' => 'Esmeralda'],
    //         ['prov_id' => 10, 'nombre' => 'Florida'],
    //         ['prov_id' => 10, 'nombre' => 'Guaimaro'],
    //         ['prov_id' => 10, 'nombre' => 'Jimagüayú'],
    //         ['prov_id' => 10, 'nombre' => 'Minas'],
    //         ['prov_id' => 10, 'nombre' => 'Najasa'],
    //         ['prov_id' => 10, 'nombre' => 'Nuevitas'],
    //         ['prov_id' => 10, 'nombre' => 'Santa Cruz del Sur'],
    //         ['prov_id' => 10, 'nombre' => 'Sibanicú'],
    //         ['prov_id' => 10, 'nombre' => 'Sierra de Cubitas'],
    //         ['prov_id' => 10, 'nombre' => 'Vertientes'],
    //         ['prov_id' => 11, 'nombre' => 'Amancio Rodríguez'],
    //         ['prov_id' => 11, 'nombre' => 'Colombia'],
    //         ['prov_id' => 11, 'nombre' => 'Jesús Menéndez'],
    //         ['prov_id' => 11, 'nombre' => 'Jobabo'],
    //         ['prov_id' => 11, 'nombre' => 'Las Tunas'],
    //         ['prov_id' => 11, 'nombre' => 'Majibacoa'],
    //         ['prov_id' => 11, 'nombre' => 'Manatí'],
    //         ['prov_id' => 11, 'nombre' => 'Puerto Padre'],
    //         ['prov_id' => 12, 'nombre' => 'Antilla'],
    //         ['prov_id' => 12, 'nombre' => 'Báguanos'],
    //         ['prov_id' => 12, 'nombre' => 'Banes'],
    //         ['prov_id' => 12, 'nombre' => 'Cacocum'],
    //         ['prov_id' => 12, 'nombre' => 'Calixto García'],
    //         ['prov_id' => 12, 'nombre' => 'Cueto'],
    //         ['prov_id' => 12, 'nombre' => 'Frank País'],
    //         ['prov_id' => 12, 'nombre' => 'Gibara'],
    //         ['prov_id' => 12, 'nombre' => 'Holguín'],
    //         ['prov_id' => 12, 'nombre' => 'Mayarí'],
    //         ['prov_id' => 12, 'nombre' => 'Moa'],
    //         ['prov_id' => 12, 'nombre' => 'Rafael Freyre'],
    //         ['prov_id' => 12, 'nombre' => 'Sagua de Tánamo'],
    //         ['prov_id' => 12, 'nombre' => 'Urbano Noris'],
    //         ['prov_id' => 13, 'nombre' => 'Contramaestre'],
    //         ['prov_id' => 13, 'nombre' => 'Guamá'],
    //         ['prov_id' => 13, 'nombre' => 'Julio Antonio Mella'],
    //         ['prov_id' => 13, 'nombre' => 'Palma Soriano'],
    //         ['prov_id' => 13, 'nombre' => 'San Luis'],
    //         ['prov_id' => 13, 'nombre' => 'Santiago de Cuba'],
    //         ['prov_id' => 13, 'nombre' => 'Segundo Frente'],
    //         ['prov_id' => 13, 'nombre' => 'Songo la Maya'],
    //         ['prov_id' => 13, 'nombre' => 'Tercer Frente'],
    //         ['prov_id' => 14, 'nombre' => 'Baracoa'],
    //         ['prov_id' => 14, 'nombre' => 'Caimanera'],
    //         ['prov_id' => 14, 'nombre' => 'El Salvador'],
    //         ['prov_id' => 14, 'nombre' => 'Guantánamo'],
    //         ['prov_id' => 14, 'nombre' => 'Imías'],
    //         ['prov_id' => 14, 'nombre' => 'Maisí'],
    //         ['prov_id' => 14, 'nombre' => 'Manuel Tames'],
    //         ['prov_id' => 14, 'nombre' => 'Niceto Pérez'],
    //         ['prov_id' => 14, 'nombre' => 'San Antonio del Sur'],
    //         ['prov_id' => 14, 'nombre' => 'Yateras'],
    //         ['prov_id' => 15, 'nombre' => 'Isla de la Juventud'],
    //         ['prov_id' => 16, 'nombre' => 'Bartolomé Masó'],
    //         ['prov_id' => 16, 'nombre' => 'Bayamo'],
    //         ['prov_id' => 16, 'nombre' => 'Buey Arriba'],
    //         ['prov_id' => 16, 'nombre' => 'Campechuela'],
    //         ['prov_id' => 16, 'nombre' => 'Cauto Cristo'],
    //         ['prov_id' => 16, 'nombre' => 'Guisa'],
    //         ['prov_id' => 16, 'nombre' => 'Jiguaní'],
    //         ['prov_id' => 16, 'nombre' => 'Manzanillo'],
    //         ['prov_id' => 16, 'nombre' => 'Media Luna'],
    //         ['prov_id' => 16, 'nombre' => 'Niquero'],
    //         ['prov_id' => 16, 'nombre' => 'Pilón'],
    //         ['prov_id' => 16, 'nombre' => 'Río Cauto'],
    //         ['prov_id' => 16, 'nombre' => 'Yara'],
    //     ]);
    // }

    public function listar()
    {
        $datos = DB::table('municipios')
                    ->join('provincias', 'municipios.prov_id', '=', 'provincias.id')
                    ->select('municipios.id','municipios.nombre as municipio','municipios.codigo','provincias.nombre as provincia')
                    ->get();
        //$datos = Municipio::All();
        echo json_encode($datos);
    }

    public function agregar(REQUEST $request)
    {
        $d = new Municipio;
        $d->nombre = e($request->input('nombre'));
        $d->prov_id = e($request->input('prov_id'));
        $d->codigo = e($request->input('codigo'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function cargarDatos(REQUEST $request)
    {
        $d = Municipio::findOrFail($request->input('id'));
        echo json_encode($d);
    }

    public function actualizar(REQUEST $request)
    {
        $d = Municipio::find($request->input('id'));
        $d->nombre = $request->input('nombre');
        $d->prov_id = e($request->input('prov_id'));
        $d->codigo = e($request->input('codigo'));

        if ($d->save()):
            echo 1;
        else:
            echo 0;
        endif;
    }

    public function eliminar(REQUEST $request)
    {
        $d = Municipio::find($request->input('id'));
        if ($d->delete()):
            echo 1;
        else:
            echo 0;
        endif;
    }
}
