<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--@yield('title')--}}
    <title>@yield('title') | Registro de Asistencias | IESTP &quot;Pedro P. Diaz&quot;</title>
    {{--<link rel="shortcut icon" href="{{ asset('/public/i_icon.png') }}" />--}}
    {{--<link rel="icon" href="https://res.cloudinary.com/dzcmxfodx/image/upload/q_auto/f_auto/v1752242660/ppd-32_dwwzgb.png" sizes="32x32" />--}}
	@include('includes.icon')

    {{--@include('includes.libraries')--}}
    @include('includes.styles')
  </head>
  <body>
    

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- Barra de arriba -->
        @include('includes.topbar')

        <!-- Contenido de la pagina -->
        @yield('content')



      </div>
    </div>
    @include('includes.scripts')
    @yield('javascript')
  </body>
</html>