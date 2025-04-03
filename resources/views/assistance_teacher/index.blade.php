@extends('layout')

@section('title')
<title>Lista de Asistencias</title>
@endsection

@section('content')

<form method="POST" id="deleteall">
    @csrf
    @method('DELETE')
</form>

<div class="container-fluid">
            <div class="col-lg-12">
              <div class="card card-default shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="card-title m-0 font-weight-bold text-primary">Lista de Asistencias <a class="btn btn-sm" href="{{ route('assistance_teacher.export') }}" title="Exportar a Excel"><i class="bi-download"></i></a></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                                <table class="table table-hover" id="datat">
                                    <thead>
                                        <tr>
                                            <!--<th></th>-->
                                            <th class="input-filter input-date" id="datepicker">Buscar</th>
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
                                    <thead class="table-light">
                                        <tr>
                                            <!--<th></th>-->
                                            <th>Fecha de subida</th>
                                            <th>Apellidos y Nombres</th>
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
                                    <tfoot class="table-light">
                                        <tr>
                                        	<th>Fecha de subida</th>
                                            <th>Apellidos y Nombres</th>
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
                                    </tfoot>
                                    <tbody>

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

    var dt = $('#datat').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        pageLength: 25,
        processing: true,
        serverSide: true,
        ajax:"{{ route('assistance_teacher') }}",
        columns: [
            //{data:'checks', name:'checks'},
            {data:'created_at', name:'created_at'},
            {data:'teacher_name', name:'teacher_name'},
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
            this.api()
                .columns('.input-filter')
                .every(function () {
                    let column = this;
                    let title = column.header().textContent;
     
                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    input.setAttribute('class', 'form-control');
                    input.setAttribute('id', column.header().id);
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
                .columns([2,3,4])
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
    
    /*new tempusDominus.TempusDominus(document.getElementById("datepicker"), {
            useCurrent: false,
            display: {
                icons: {
                  time: 'bi bi-clock',
                  date: 'bi bi-calendar',
                  up: 'bi bi-arrow-up',
                  down: 'bi bi-arrow-down',
                  previous: 'bi bi-chevron-left',
                  next: 'bi bi-chevron-right',
                  today: 'bi bi-calendar-check',
                  clear: 'bi bi-trash',
                  close: 'bi bi-x',
                },
                viewMode: 'calendar',
                components: {
                  decades: false,
                  year: true,
                  month: true,
                  date: true,
                  hours: false,
                  minutes: false,
                  seconds: false
                },
            },
            localization: {
                locale: 'en',
                format: "yyyy-MM-dd"
            },
        });*/

    /*$('.swalDefaultSuccess').click(function(){
        Swal.fire({
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        })
    });*/

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection