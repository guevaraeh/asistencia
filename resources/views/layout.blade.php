<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--@yield('title')--}}
    <title>Registro de Asistencias | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/i_icon.png') }}" />
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