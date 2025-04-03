@extends('layout')

@section('title')
<title>Lista de profesores</title>
@endsection

@section('content')
<div class="container">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary">Lista de profesores</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                                <table class="table table-hover" id="datat">
                                    <thead>
                                        <tr class="table-light">
                                            <th>#</th>
                                            <th>Apellidos</th>
                                            <th>Nombres</th>
                                            <th>Nro. de registros de asistencia</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teacher->lastname }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->assistances->count() }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-primary" title="Ver registros de asistencia"><i class="bi-eye"></i></a>
                                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-info" title="Editar"><i class="bi-pencil"></i></a>
                                                    <a href="{{ route('teacher.create_assistance', $teacher->id) }}" class="btn btn-secondary" title="Crear Asistencia"><i class="bi-card-checklist"></i></a>
                                                    <a href="{{ route('teacher.export', $teacher->id) }}" class="btn btn-warning" title="Descargar Excel"><i class="bi-download"></i></a>
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
    
    $('#datat').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection