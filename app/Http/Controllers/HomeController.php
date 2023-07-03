<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }

    public function index()
    {
        $m = DB::table('colaboradores')
                ->where('sexo','=','M')
                ->count();

        $f = DB::table('colaboradores')
            ->where('sexo','=','F')
            ->count();

        $data = [
            'hombres' => $m,
            'mujeres' => $f
        ];

        return view('home',$data);
    }
}
