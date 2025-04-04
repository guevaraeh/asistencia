@extends('layout')

@section('title')
<title>Asistencia Registrada</title>
@endsection

@section('content')
<div class="container">

    <div class="card text-center border-success mb-3">
        <div class="card-header text-success border-success">
            Prof. {{ $teacher->name . ' ' . $teacher->lastname }}
        </div>
        <div class="card-body text-success ">
            <h2 class="card-title">Asistencia Registrada</h2>
            <p class="card-text">Cierre la sesión y proceda con la clase.</p>
            <form id="h1-logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Cerrar Sesión</button>
            </form>
        </div>
        <div class="card-footer text-success border-success">
            Fecha y hora de subida: {{ date('Y-m-d h:i A', time()) }}
        </div>
    </div>

</div>
@endsection