<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGECOL | @yield('titulo')</title>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<meta name="routeName" content="{{Route::currentRouteName()}}">
    <!-- Fuente -->
	<link rel="stylesheet" href="{{ asset('plantilla/dist/fonts/Sans.css') }}">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ asset('plantilla/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plantilla/dist/css/adminlte.min.css') }}">
</head>
<body>
    @yield('content')
</body>
</html>
