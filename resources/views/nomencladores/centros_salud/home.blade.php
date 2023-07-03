@extends('layouts.app')

@section('titulo', 'Centros de Salud')

@section('nav-superior')
<li class="breadcrumb-item"><a href="{{ route('cs_home') }}">Centros de Salud</a></li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado general de los Centros de Salud donde trabajan los colaboradores</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button class="btn btn-primary" type="button" onclick="showModalNuevo()">
            <i class="fa fa-plus fa-sm"></i> Agregar Centro de Salud
        </button>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center" id="tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Atendido Por</th>
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

<div class="modal fade" id="centros_saludModal" style="padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['id'=>"frmNuevo", 'method'=>"POST", 'onsubmit'=>"return nuevo()"]) !!}
            {!! Form::text('id', null, ['id'=>'id','hidden']) !!}
            <div class="modal-header">
            <h4 class="modal-title" id="titulo-centros_salud">Agregar Centro de Salud</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-danger">×</span>
            </button>
            </div>
            <div class="modal-body">
                {!! Form::label('nombre', 'Nombre', ['class'=>'form-label']) !!}
                {!! Form::text('nombre', null, ['id'=>'nombre','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                {!! Form::label('jefe_id', 'Jefe Colaboración que atiende el centro', ['class'=>'form-label']) !!}
                <select name="jefe_id" id="jefe_id" class="select2" style="width: 100%" required>
                    <option value="">Seleccionar</option>
                    @foreach ($jefes as $jefe)
                        <option value="{{$jefe['id']}}">{{$jefe['text']}}</option>
                    @endforeach
                </select>
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
<script src="{{ asset('js/paginas/centros_salud.js') }}"></script>
@endsection
