@extends('layout')

@section('title')
<title>Inicio</title>
@endsection

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">
        Asistencia registrada
        <form id="h1-logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Cerrar sesion</button>
        </form>
    </h1>
</div>
@endsection