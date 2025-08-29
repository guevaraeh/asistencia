@extends('layout')

@section('title')
Lista de profesores
@endsection

@section('content')

<form method="POST" id="deleteall">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <h5 class="card-title text-primary">Lista de Docentes</h5>
			<div class="card-tools">
            <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Crear Docente
            </a>
        	</div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="datat">
                <thead>
                    <tr class="table-light">
                        <th>#</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Area</th>
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
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->area }}</td>
                        <td>{{ $teacher->assistances->count() }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-primary btn-sm" title="Ver registros de asistencia"><i class="bi-eye"></i></a>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="bi-pencil"></i></a>
                                <a href="{{ route('teacher.create_assistance', $teacher->id) }}" class="btn btn-secondary btn-sm" title="Crear Asistencia"><i class="bi-card-checklist"></i></a>
                                <a href="{{ route('teacher.export', $teacher->id) }}" class="btn btn-warning btn-sm" title="Descargar Excel"><i class="bi-download"></i></a>

                                <button type="button" class="btn btn-danger btn-sm swalDelete" form="deleteall" formaction="{{ route('teacher.destroy',$teacher->id) }}" value="{{ $teacher->lastname . ' ' . $teacher->name }}" title="Eliminar"><i class="bi-trash"></i></button>
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
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

    $('.swalDelete').click(function(){
        Swal.fire({
            title: '¿Esta seguro que desea eliminar a '+$(this).val()+'?',
            text: 'También eliminará todas sus asistencias registradas.',
            showDenyButton: true,
            confirmButtonText: "Si, eliminar",
            denyButtonText: "No, cancelar",
            icon: "warning",
            customClass: {
                confirmButton: 'btn btn-primary',
                denyButton: 'btn btn-danger'
            }
        }).then((result) => {
            if(result.isConfirmed){
                $('#deleteall').attr('action', $(this).attr('formaction'));
                $('#deleteall').submit();
            }
        })
    });

});
</script>
@endsection