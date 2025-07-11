@extends('layout')

@section('title')
Comentarios y sugerencias
@endsection

@section('content')
<div class="container">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="card-title text-primary">Comentarios y sugerencias</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                                <table class="table table-hover" id="datat">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Creado</th>
                                            <th>Docente</th>
                                            <th>Comentario o sugerencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->created_at }}</td>
                                            <td>{{ $comment->teacher->lastname . ' ' . $comment->teacher->name }}</td>
                                            <td>{{ $comment->text_comment }}</td>
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
        lengthChange: false,
        pageLength: 20,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        order: [[0, 'desc']]
    });

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection