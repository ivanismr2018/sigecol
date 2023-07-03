@extends('reporte.plantilla')

@section('contenido')
<table style="width: 100%; border-collapse: collapse" border="1">
    <thead>
        <th>Nombre y Apellidos</th>
        <th>Municipio de Recidencia</th>
        <th>Centro de Salud</th>
        <th>Especialidad</th>
    </thead>
    <tbody>
        @foreach ($paises as $pais)
        <tr style="background-color: rgb(194, 194, 194)">
            <th colspan="4">{{ $pais->nombre }}</th>
        </tr>
            @foreach ($datos as $dato)
                @if ($dato->idpais == $pais->idpais)
                    <tr>
                        <td>{{ $dato->nombre." ".$dato->apellidos }}</td>
                        <td>{{ $dato->municipio }}</td>
                        <td>{{ $dato->centro_salud }}</td>
                        <td>{{ $dato->especialidad }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
