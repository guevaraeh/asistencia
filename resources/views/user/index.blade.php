@extends('layout')

@section('title')
<title>Usuarios</title>
@endsection

@section('content')
<div class="container">
    <div class="col-lg-12">

        @if (Session::has('changed'))
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            {!! session('changed') !!}
        </div>
        @endif

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary">Usuarios</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Admin</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Si' : 'No' }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="bi-pencil"></i></a>
                                <a href="{{ route('user.reset_password', $user->id) }}" class="btn btn-warning btn-sm" title="Regenerar contraseña"><i class="bi-lock"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$( document ).ready(function() {
    
    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection