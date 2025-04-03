@extends('layout')

@section('title')
<title>Editar Profesor</title>
@endsection

@section('content')
<div class="container">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary">Editar profesor</h5>
                </div>
                <div class="card-body">
                  <form action="{{ route('teacher.update', $teacher->id) }}" method="POST">
                  	@csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"><b>Nombre(s)</b><font color="red">*</font></label>
                      <input type="text" class="form-control" id="exampleFirstName" name="name" value="{{ $teacher->name }}" required>
                    </div>

                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"><b>Apellido(s)</b><font color="red">*</font></label>
                      <input type="text" class="form-control" id="exampleLastName" name="lastname" value="{{ $teacher->lastname }}" required>
                    </div>

                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                      <a href="{{ route('teacher') }}" class="btn btn-danger">Cancelar</a>
                    </div>

                  </form>
                </div>
              </div>
            </div>
@endsection