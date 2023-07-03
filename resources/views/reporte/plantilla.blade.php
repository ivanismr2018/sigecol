@php
$path = asset('logo.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<style type="text/css">
    html,body {
       font-family:interstate;
      height:100%;
      width:100%;
      overflow:auto;
      margin-top: 20px;
   margin-bottom: 60px;
   min-height: 100%;
  }
    #footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    right: 0px;
    height: 80px;
  }
  .pagenum:before {
    content: counter(page);
  }
  </style>

  <img src="{{$base64}}" alt="logo" style="width: 50px; margin-left: 0px">
  <b style="margin-left: 100px">Fecha del Reporte:</b> <label><?php echo date('d-m-Y') ?></label>
  <hr>

@yield('contenido')

<div id="footer">
<center>
<p style="text-align: right;"> Pág: <b><span class="pagenum"></span></b></p>
<hr>
<label>SIGECOL: Sistema de Gestión de Colaboradores</label>
<label style="margin-left: 60px">Contacto: ivanis.mirabal@nauta.cu </label>
<label style="margin-left: 60px">Dirección: {{ url('') }}</label>
</center>
</div>
