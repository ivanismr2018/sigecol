@extends('layouts.app')

@section('titulo', 'Colaboradores')

@section('nav-superior')
<li class="breadcrumb-item"><a href="{{ route('colaboradores_home') }}">Colaboradores</a></li>
@endsection

@section('contenido')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Listado general de colaboradores</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<button class="btn btn-primary" type="button" onclick="showModalNuevo()">
					<i class="fa fa-plus fa-sm"></i> Agregar Colaborador
				</button>
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalReporte">
					<i class="fa fa-print fa-sm"></i> Generar Reporte
				</button>
				<hr>
				<div class="table-responsive">
					<table class="table table-hover table-striped align-middle text-center" id="tabla">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Centro Laboral</th>
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

<div class="modal fade" id="modalReporte" style="padding-right: 15px;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reportes</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-danger">×</span>
				</button>
			</div>
			<div class="modal-body text-center">
                <div class="row" style="margin-top: 10px">
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Por Países</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Por Jefes</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Por Centro de Salud</a>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Por Especialidad</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Por Municipio de Residencia</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Estadístico</a>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Todos los Colaboradores</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Fin de Misión</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ url('reportes/paises') }}" class="btn btn-primary">Misión en Curso</a>
                    </div>
                </div>
			</div>
			<div class="modal-footer justify-content-between">
                <button class="btn btn-info btn-block" type="button">Especificar Reporte</button>
			</div>
			{!! Form::close() !!}
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="colaboradorModal" style="padding-right: 15px;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{!! Form::open(['id'=>"frmNuevo", 'method'=>"POST", 'onsubmit'=>"return nuevo()"]) !!}
			{!! Form::text('id', null, ['id'=>'id','hidden']) !!}
			<div class="modal-header">
				<h4 class="modal-title" id="titulo-colaboradores">Agregar Jefe</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-danger">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						{!! Form::label('nombre', 'Nombre', ['class'=>'form-label']) !!}
						{!! Form::text('nombre', null, ['id'=>'nombre','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
						{!! Form::label('ci', 'Carnet de Identidad', ['class'=>'form-label']) !!}
						{!! Form::text('ci', null, ['id'=>'ci','class'=>'form-control','autocomplete'=>'off','required'=>'true','data-inputmask'=>'"mask": "99999999999"', 'data-mask']) !!}
						{!! Form::label('sexo', 'Sexo', ['class'=>'form-label']) !!}
                        {!! Form::select('sexo', [''=>'Seleccionar','M'=>'Masculino','F'=>'Femenino'], 0, ['class'=>'select2','style'=>'width:100%']) !!}
						{!! Form::label('centro', 'Centro Laboral', ['class'=>'form-label']) !!}
                        <select name="centro" id="centro" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            @foreach ($centros as $centro)
                                <option value="{{$centro['id']}}">{{$centro['text']}}</option>
                            @endforeach
                        </select>
					</div>

					<div class="col-6">
						{!! Form::label('apellidos', 'Apellidos', ['class'=>'form-label']) !!}
						{!! Form::text('apellidos', null, ['id'=>'apellidos','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
						{!! Form::label('direccion', 'Direccion', ['class'=>'form-label']) !!}
						{!! Form::text('direccion', null, ['id'=>'direccion','class'=>'form-control','autocomplete'=>'off','required'=>'true']) !!}
						{!! Form::label('municipio', 'Municipio', ['class'=>'form-label']) !!}
                        <select name="municipio" id="municipio" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{$municipio['id']}}">{{$municipio['text']}}</option>
                            @endforeach
                        </select>
						{!! Form::label('especialidad', 'Especialidad', ['class'=>'form-label']) !!}
                        <select name="especialidad" id="especialidad" class="select2" style="width: 100%">
                            <option value="">Seleccionar</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{$especialidad['id']}}">{{$especialidad['text']}}</option>
                            @endforeach
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
<script src="{{ asset('js/paginas/colaboradores.js') }}"></script>
@endsection
