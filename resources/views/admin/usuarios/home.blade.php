@extends('layouts.app')

@section('titulo', 'Usuarios')

@section('nav-superior')
<li class="breadcrumb-item"><a href="{{ route('usuarios_home') }}">Usuarios</a></li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado general de usuairos</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button class="btn btn-primary" type="button" onclick="showModalNuevo()">
            <i class="fa fa-plus fa-sm"></i> Agregar Usuario
        </button>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center" id="tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Entidad</th>
                        <th>Estado</th>
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

<div class="modal fade" id="usuarioModal" style="padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        {!! Form::open(['id'=>"frmNuevo", 'method'=>"POST", 'onsubmit'=>"return nuevo()"]) !!}
            {!! Form::text('id', null, ['id'=>'id','hidden']) !!}
            <div class="modal-header">
            <h4 class="modal-title" id="titulo-usuario">Agregar Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-danger">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('name', 'Nombre Completo', ['class'=>'form-label']) !!}
                        {!! Form::text('name', null, ['id'=>'name','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                        {!! Form::label('ci', 'Carnet de Identidad', ['class'=>'form-label']) !!}
						{!! Form::text('ci', null, ['id'=>'ci','class'=>'form-control','autocomplete'=>'off','required'=>'true','data-inputmask'=>'"mask": "99999999999"', 'data-mask']) !!}
                        {!! Form::label('cargo', 'Cargo', ['class'=>'form-label']) !!}
                        {!! Form::text('cargo', null, ['id'=>'cargo','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                        {!! Form::label('password', 'Contraseña', ['class'=>'form-label']) !!}
                        {!! Form::password('password', ['id'=>'password','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                    </div>
                    <div class="col-6">
                        {!! Form::label('email', 'Correo Electrónico', ['class'=>'form-label']) !!}
                        {!! Form::text('email', null, ['id'=>'email','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                        {!! Form::label('jefe_id', 'Entidad', ['class'=>'form-label']) !!}
                        <select name="jefe_id" id="jefe_id" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            @foreach ($jefes as $jefe)
                                <option value="{{$jefe['id']}}">{{$jefe['text']}}</option>
                            @endforeach
                        </select>
                        {!! Form::label('rol', 'Nivel de Acceso', ['class'=>'form-label']) !!}
                        <select name="rol" id="rol" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            <option value="1">Municipio</option>
                            <option value="2">Provincia</option>
                            <option value="3">Administrador</option>
                        </select>
                        {!! Form::label('estado', 'Estado', ['class'=>'form-label']) !!}
                        <select name="estado" id="estado" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
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
<script src="{{ asset('js/paginas/usuarios.js') }}"></script>
@endsection
