@extends('layout')

@section('title')
Editar usuario
@endsection

@section('content')
<div class="container">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="card-title text-primary">Editar usuario</h5>
      </div>
      <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">	
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"><b>Usuario</b><font color="red">*</font></label>
              <input type="text" class="form-control" id="exampleUserName" name="username" value="{{ $user->username }}" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"><b>Nombre</b><font color="red">*</font></label>
              <input type="text" class="form-control" id="exampleName" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"><b>Correo</b><font color="red">*</font></label>
              <input type="email" class="form-control" id="exampleEmail" name="email" value="{{ $user->email }}" required>
            </div>            

        </div>
        <div class="card-footer py-3">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="{{ route('user') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="card-title text-primary">Cambiar Contraseña</h5>
      </div>
      <form action="{{ route('user.update_password', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body"> 
           
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"><b>Contraseña</b><font color="red">*</font></label>
              <input type="password" class="form-control" id="exampleEmail" name="password" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"><b>Repite Contraseña</b><font color="red">*</font></label>
              <input type="password" class="form-control" id="exampleEmail" name="repeat_password" required>
            </div>            

        </div>
        <div class="card-footer py-3">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="{{ route('user') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@section('javascript')
<script>
$( document ).ready(function() {
    
    @if(Session::has('error'))
    toastr.error('<strong>¡Error!</strong><br>'+'{{ session("error") }}');
    @endif

});
</script>
@endsection