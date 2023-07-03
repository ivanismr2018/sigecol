@extends('layouts.app')

@section('titulo', 'Misiones del Colaborador')

@section('nav-superior')
<li class="breadcrumb-item"><a href="{{ route('colaboradores_home') }}">Colaboradores</a></li>
<li class="breadcrumb-item"><a href="">Misiones</a></li>
@endsection

@section('contenido')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Listado de las misiones</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<button class="btn btn-primary" type="button" onclick="showModalNuevo()">
					<i class="fa fa-plus fa-sm"></i> Agregar Misión
				</button>
				<hr>
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6">
                        <h5>Nombre y Apellidos</h5>
                        <label><?= $datos[0]->nombre." ".$datos[0]->apellidos ?></label>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Municipio Recidencia</h5>
                        <label><?= $datos[0]->municipio ?></label>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Centro Laboral</h5>
                        <label><?= $datos[0]->centro ?></label>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Especialidad</h5>
                        <label><?= $datos[0]->especialidad ?></label>
                    </div>
                </div>
                <hr>
				<div class="table-responsive">
					<table class="table table-hover table-striped align-middle text-center" id="tabla">
						<thead>
							<tr>
								<th>Pais</th>
								<th>Tipo Misión</th>
								<th>Salida</th>
								<th>Regreso</th>
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

<div class="modal fade" id="misionModal" style="padding-right: 15px;" aria-modal="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['id'=>"frmNuevo", 'method'=>"POST", 'onsubmit'=>"return nuevo()"]) !!}
			{!! Form::text('id', null, ['id'=>'id','hidden']) !!}
			{!! Form::text('colaborador', $colaborador, ['id'=>'colaborador','hidden']) !!}
			<div class="modal-header">
				<h4 class="modal-title" id="titulo-misiones">Agregar Jefe</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-danger">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
                    {!! Form::label('fecha_salida', 'Fecha Salida', ['class'=>'form-label']) !!}
                    {!! Form::date('fecha_salida', null, ['id'=>'fecha_salida','class'=>'form-control','required']) !!}
                    {!! Form::label('tipo_mision', 'Tipo de Misión', ['class'=>'form-label']) !!}
                    {!! Form::text('tipo_mision', null, ['id'=>'tipo_mision','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
                    {!! Form::label('pais', 'País', ['class'=>'form-label']) !!}
                    <select name="pais" id="pais" class="select2" style="width: 100%" required>
                        <option value="">Seleccionar</option>
                        @foreach ($paises as $pais)
                            <option value="{{$pais['id']}}">{{$pais['text']}}</option>
                        @endforeach
                    </select>
                    {!! Form::label('fecha_regreso', 'Fecha Regreso', ['class'=>'form-label']) !!}
                    {!! Form::date('fecha_regreso', null, ['id'=>'fecha_regreso','class'=>'form-control','required']) !!}
                    {!! Form::label('estado', 'Estado de la Misión', ['class'=>'form-label']) !!}
                    {!! Form::select('estado', [''=>'Seleccionar','0'=>'En Curso','1'=>'Finalizada'], 0, ['class'=>'select2','style'=>'width: 100%','required']) !!}
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
<script src="{{ asset('js/paginas/misiones.js') }}"></script>
@endsection
