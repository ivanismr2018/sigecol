@extends('layouts.app')

@section('titulo', 'Paises')

@section('nav-superior')
<li class="breadcrumb-item"><a href="{{ route('pais_home') }}">Paises</a></li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado general de paises con colaboradores</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button class="btn btn-primary" type="button" onclick="showModalNuevo()">
            <i class="fa fa-plus fa-sm"></i> Agregar País
        </button>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center" id="tabla">
                <thead>
                    <tr>
                        <th class='notexport'></th>
                        <th>Nombre</th>
                        <th>ISO</th>
                        <th class='notexport'>Opciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>


{{-- Modals --}}

<div class="modal fade" id="paisesModal" style="padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['id'=>"frmNuevo", 'method'=>"POST", 'onsubmit'=>"return nuevo()"]) !!}
            {!! Form::text('id', null, ['id'=>'id','hidden']) !!}
            <div class="modal-header">
            <h4 class="modal-title" id="titulo-paises">Agregar País</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-danger">×</span>
            </button>
            </div>
            <div class="modal-body">
                {!! Form::label('nombre', 'Nombre', ['class'=>'form-label']) !!}
                {!! Form::text('nombre', null, ['id'=>'nombre','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                {!! Form::label('iso', 'ISO', ['class'=>'form-label']) !!}
                {!! Form::text('iso', null, ['id'=>'iso','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar Datos</button>
            </div>
        {!! Form::close() !!}
    </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@stop

@section('js')
<script src="{{ asset('js/paginas/paises.js') }}"></script>
@endsection
