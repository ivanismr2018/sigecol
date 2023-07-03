@extends('layouts.app')

@section('titulo', 'Panel de Control')

@section('contenido')
<div class="row">
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-primary text-center">
            <div class="inner">
            <h1><b>{{$hombres+$mujeres}}</b></h1>

            <h4>Total de Colaboradores</h4>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-red text-center">
            <div class="inner">
            <h1><b>{{$hombres}}</b></h1>

            <h4>Hombres</h4>
            </div>
            <div class="icon">
            <i class="fa fa-mars"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-pink text-center">
            <div class="inner">
            <h1><b>{{$mujeres}}</b></h1>

            <h4>Mujeres</h4>
            </div>
            <div class="icon">
            <i class="fa fa-venus"></i>
            </div>
        </div>
    </div>
</div>
@stop
