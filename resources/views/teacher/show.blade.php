@extends('layout')

@section('title')
<title>Registro de asistencias de {{ $teacher->name . ' ' . $teacher->lastname }}</title>
@endsection

@section('content')

<form method="POST" id="deleteall">
    @csrf
    @method('DELETE')
</form>

<div class="container-fluid">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary">Registro de asistencias de {{ $teacher->name . ' ' . $teacher->lastname }} <a class="btn btn-sm" href="{{ route('teacher.export', $teacher->id) }}" title="Exportar a Excel"><i class="bi-download"></i></a></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                                <table class="table table-hover" id="datat">
                                    <thead>
                                        <tr>
                                            <!--<th></th>-->
                                            <th class="input-filter">Buscar</th>
                                            <th class="select-module"></th>
                                            <th class="select-period"></th>
                                            <th class="select-turn"></th>
                                            {{--<th></th>--}}
                                            <th class="input-filter">Buscar</th>
                                            <th class="input-filter">Buscar</th>
                                            {{--<th></th>--}}
                                            <th class="input-filter">Buscar</th>
                                            <th class="input-filter">Buscar</th>
                                            {{--<th>Buscar</th>--}}
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr class="table-light">
                                            <!--<th></th>-->
                                            <th>Fecha de subida</th>
                                            <th>Módulo Formativo</th>
                                            <th>Período Académico</th>
                                            <th>Turno/Sección</th>
                                            {{--<th>Unidad Didáctica</th>--}}
                                            <th>Hora de ingreso</th>
                                            <th>Hora de salida</th>
                                            {{--<th>Tema de actividad de aprendizaje</th>--}}
                                            <th>Lugar</th>
                                            <th>Plataformas de apoyo</th>
                                            {{--<th>Observaciones</th>--}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="table-light">
                                            <th>Fecha de subida</th>
                                            <th>Módulo Formativo</th>
                                            <th>Período Académico</th>
                                            <th>Turno/Sección</th>
                                            {{--<th>Unidad Didáctica</th>--}}
                                            <th>Hora de ingreso</th>
                                            <th>Hora de salida</th>
                                            {{--<th>Tema de actividad de aprendizaje</th>--}}
                                            <th>Lugar</th>
                                            <th>Plataformas de apoyo</th>
                                            {{--<th>Observaciones</t>--}}
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        {{--
                                        @foreach($assistances as $assistance_teacher)
                                        <tr>
                                            <td><small>{{ date('Y/m/d h:i A', strtotime($assistance_teacher->created_at)) }}</small></td>
                                            <td><small>{{ $assistance_teacher->training_module }}</small></td>
                                            <td><small>{{ $assistance_teacher->period }}</small></td>
                                            <td><small>{{ $assistance_teacher->turn }}</small></td>
                                            <td><small>{{ $assistance_teacher->didactic_unit }}</small></td>
                                            <td><small>{{ date('h:i A', strtotime($assistance_teacher->checkin_time)) }}</small></td>
                                            <td><small>{{ date('h:i A', strtotime($assistance_teacher->departure_time)) }}</small></td>
                                            <td><small>{{ $assistance_teacher->theme }}</small></td>
                                            <td><small>{{ $assistance_teacher->place }}</small></td>
                                            <td><small>{{ $assistance_teacher->educational_platforms }}</small></td>
                                            <td><small>{{ $assistance_teacher->remarks }}</small></td>
                                        </tr>
                                        @endforeach
                                        --}}
                                    </tbody>
                                </table>
                            </div>
                            {{-- $assistances->links() --}}
                </div>
              </div>
            </div>
</div>
@endsection

@section('javascript')
<script>
$( document ).ready(function() {

    /*$('#datat').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
    });*/

    var dt = $('#datat').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax:"{{ route('teacher.show', $teacher->id) }}",
        columns: [
            {data:'created_at', name:'created_at'},
            {data:'training_module', name:'training_module'},
            {data:'period', name:'period'},
            {data:'turn', name:'turn'},
            //{data:'didactic_unit', name:'didactic_unit'},
            {data:'checkin_time', name:'checkin_time'},
            {data:'departure_time', name:'departure_time'},
            //{data:'theme', name:'theme'},
            {data:'place', name:'place'},
            {data:'educational_platforms', name:'educational_platforms'},
            //{data:'remarks', name:'remarks'},
            {data:'action', name:'action'},
        ],

                initComplete: function () {
            //$("#dt-length-0").attr("class","form-select");
            //$("#dt-search-0").attr("class","form-control");
            this.api()
                .columns('.input-filter')
                .every(function () {
                    let column = this;
                    let title = column.header().textContent;
     
                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    input.setAttribute('class', 'form-control');
                    //column.footer().replaceChildren(input);
                    column.header().replaceChildren(input);
     
                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            /*this.api()
                .columns([1,2,3])
                .every(function () {
                    let column = this;
     
                    // Create select element
                    let select = document.createElement('select');
                    select.setAttribute('class', 'form-select');
                    select.add(new Option(''));
                    column.footer().replaceChildren(select);
                    
                    // Add list of options
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.add(new Option(d));
                        });

                    // Apply listener for user change in value
                    select.addEventListener('change', function () {
                        column
                            .search(select.value, {exact: true})
                            .draw();
                    });
                });*/

            this.api()
                .columns('.select-module')
                .every(function () {
                    let column = this;
     
                    // Create select element
                    let select = document.createElement('select');
                    select.setAttribute('class', 'form-select');
                    select.add(new Option(''));
                    //column.footer().replaceChildren(select);
                    column.header().replaceChildren(select);
                    
                    // Add list of options
                    select.add(new Option('Profesional/Especialidad'));
                    select.add(new Option('Transversal/Empleabilidad'));

                    // Apply listener for user change in value
                    select.addEventListener('change', function () {
                        column
                            .search(select.value, {exact: true})
                            .draw();
                    });
                });

            this.api()
                .columns('.select-period')
                .every(function () {
                    let column = this;
     
                    // Create select element
                    let select = document.createElement('select');
                    select.setAttribute('class', 'form-select');
                    select.add(new Option(''));
                    //column.footer().replaceChildren(select);
                    column.header().replaceChildren(select);
                    
                    // Add list of options
                    @foreach ($periods as $period)
                    select.add(new Option('{{ $period->name }}'));
                    @endforeach

                    // Apply listener for user change in value
                    select.addEventListener('change', function () {
                        column
                            .search(select.value, {exact: true})
                            .draw();
                    });
                });

            this.api()
                .columns('.select-turn')
                .every(function () {
                    let column = this;
     
                    // Create select element
                    let select = document.createElement('select');
                    select.setAttribute('class', 'form-select');
                    select.add(new Option(''));
                    //column.footer().replaceChildren(select);
                    column.header().replaceChildren(select);
                    
                    // Add list of options
                    select.add(new Option('Diurno'));
                    select.add(new Option('Nocturno'));

                    // Apply listener for user change in value
                    select.addEventListener('change', function () {
                        column
                            .search(select.value, {exact: true})
                            .draw();
                    });
                });


        }

    });

    dt.on('draw', function() {
        $('.swalDefaultSuccess').click(function(){
            Swal.fire({
                title: '¿Esta seguro que desea eliminarlo?',
                text: 'Registro de asistencia del '+$(this).val(),
                showDenyButton: true,
                //showCancelButton: true,
                confirmButtonText: "Si, eliminarlo",
                denyButtonText: "No, cancelar",
                icon: "warning",
            }).then((result) => {
                if(result.isConfirmed){
                    $('#deleteall').attr('action', $(this).attr('formaction'));
                    $('#deleteall').submit();
                }
            })
        });

    });

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection