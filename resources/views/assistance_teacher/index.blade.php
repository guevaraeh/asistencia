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
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="card-title text-primary">Lista de Asistencias <a class="btn btn-sm" href="{{ route('assistance_teacher.export') }}" title="Exportar a Excel"><i class="bi-download"></i></a></h5>
                </div>
                <div class="card-body">

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Rango</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="init-date" value="{{ date('Y-m-d', strtotime('-1 days')) }}" readonly>
                                <input type="text" class="form-control" id="end-date" value="{{ date('Y-m-d', time()) }}" readonly>
                                <!--<button type="button" id="export" class="btn btn-primary">Generar</button>-->
                                <a href="#" id="ranks" class="btn btn-primary">.xlsx</a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Por mes</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="set-month" value="{{ date('Y-m', time()) }}" readonly>
                                <a href="#" id="months" class="btn btn-primary">.xlsx</a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Por año</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="set-year" value="{{ date('Y', time()) }}" readonly>
                                <a href="#" id="years" class="btn btn-primary">.xlsx</a>
                            </div>
                        </div>

                    </div>

                    <hr>

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
                                            {{--<th class="input-filter">Buscar</th>--}}
                                            {{--<th class="input-filter">Buscar</th>--}}
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
                                            {{--<th>Lugar</th>--}}
                                            {{--<th>Plataformas de apoyo</th>--}}
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
                                            {{--<th>Lugar</th>--}}
                                            {{--<th>Plataformas de apoyo</th>--}}
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

/****************************************************************************************************************/

    var dt = $('#datat').DataTable({
        //searching : false,
        //lengthChange: false,
        pageLength: 20,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
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
            //{data:'place', name:'place'},
            //{data:'educational_platforms', name:'educational_platforms'},
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

    //$(".dt-search").html('');

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


/******************************************************************************************************************************/
    
    var route = "{{ route('assistance_teacher.export_by_range') }}"+"/";
    $("#ranks").attr("href", route+$('#init-date').val()+"/"+$('#end-date').val());

    var route_date = "{{ route('assistance_teacher.export_by_date') }}"+"/";
    $("#months").attr("href", route_date+$('#set-month').val());
    $("#years").attr("href", route_date+$('#set-year').val());

    const linkedPicker1Element = document.getElementById("init-date");
    const linked1 = new tempusDominus.TempusDominus(linkedPicker1Element, {
      display: {
            icons: {
              //time: 'bi bi-clock',
              date: 'bi bi-calendar',
              up: 'bi bi-arrow-up',
              down: 'bi bi-arrow-down',
              previous: 'bi bi-chevron-left',
              next: 'bi bi-chevron-right',
              today: 'bi bi-calendar-check',
              clear: 'bi bi-trash',
              close: 'bi bi-x',
            },
            components: {
                clock: false,
                hours: false,
                minutes: false,
                seconds: false,
            },
        },
      localization: {
            locale: 'en',
            format: "yyyy-MM-dd"
        },
      restrictions: {
            maxDate: document.getElementById("end-date").value,
        }
    });
    const linked2 = new tempusDominus.TempusDominus(document.getElementById("end-date"), {
        useCurrent: false,
        display: {
            icons: {
              //time: 'bi bi-clock',
              date: 'bi bi-calendar',
              up: 'bi bi-arrow-up',
              down: 'bi bi-arrow-down',
              previous: 'bi bi-chevron-left',
              next: 'bi bi-chevron-right',
              today: 'bi bi-calendar-check',
              clear: 'bi bi-trash',
              close: 'bi bi-x',
            },
            components: {
                clock: false,
                hours: false,
                minutes: false,
                seconds: false,
            },
        },
        localization: {
            locale: 'en',
            format: "yyyy-MM-dd"
        },
        restrictions: {
            minDate: document.getElementById("init-date").value,
        }
    });

    linkedPicker1Element.addEventListener(tempusDominus.Namespace.events.change, (e) => {
        linked2.updateOptions({
            restrictions: {
            minDate: e.detail.date,
            },
        });
        $("#ranks").attr("href", route+$('#init-date').val()+"/"+$('#end-date').val());
    });

    const subscription = linked2.subscribe(tempusDominus.Namespace.events.change, (e) => {
        linked1.updateOptions({
            restrictions: {
            maxDate: e.date,
            },
        });
        $("#ranks").attr("href", route+$('#init-date').val()+"/"+$('#end-date').val());
    });


    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/
    /*$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: "DELETE",
        data: data,
        success: function(response) {
            let successHtml = '<div class="alert alert-success" role="alert"><b>Project Deleted Successfully</b></div>';
            $("#alert-div").html(successHtml);
            showAllProjects();
        },
        error: function(response) {
            console.log(response.responseJSON)
        }
    });*/
    $("#export").click(function(){
        //alert("Presionado");
        $.ajax({
            method: "POST",
            url: "{{ route('assistance_teacher.export_ajax') }}", 
            data: {
                ini: $('#init-date').val(),
                end: $('#end-date').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(result){
                //$("#div1").html(result);
                console.log($('#init-date').val());
                console.log($('#end-date').val());
                //console.log(result);
            }
        });
    });


    const month = new tempusDominus.TempusDominus(document.getElementById("set-month"), {
        useCurrent: false,
        display: {
            icons: {
              //time: 'bi bi-clock',
              date: 'bi bi-calendar',
              up: 'bi bi-arrow-up',
              down: 'bi bi-arrow-down',
              previous: 'bi bi-chevron-left',
              next: 'bi bi-chevron-right',
              today: 'bi bi-calendar-check',
              clear: 'bi bi-trash',
              close: 'bi bi-x',
            },
            viewMode: 'months',
            components: {
                date: false,
                //month: false,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false,
            }
        },
        localization: {
            locale: 'en',
            format: "yyyy-MM"
        },
    });

    const year = new tempusDominus.TempusDominus(document.getElementById("set-year"), {
        useCurrent: false,
        display: {
            icons: {
              //time: 'bi bi-clock',
              date: 'bi bi-calendar',
              up: 'bi bi-arrow-up',
              down: 'bi bi-arrow-down',
              previous: 'bi bi-chevron-left',
              next: 'bi bi-chevron-right',
              today: 'bi bi-calendar-check',
              clear: 'bi bi-trash',
              close: 'bi bi-x',
            },
            viewMode: 'years',
            components: {
                date: false,
                month: false,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false,
            }
        },
        localization: {
            locale: 'en',
            format: "yyyy"
        },
    });

    const submonth = month.subscribe(tempusDominus.Namespace.events.change, (e) => {
        $("#months").attr("href", route_date+$('#set-month').val());
    });

    const subyear = year.subscribe(tempusDominus.Namespace.events.change, (e) => {
        $("#years").attr("href", route_date+$('#set-year').val());
    });


/*****************************************************************************************************************************************/

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection