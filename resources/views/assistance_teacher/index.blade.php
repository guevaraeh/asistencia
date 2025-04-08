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


                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Busqueda</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Exportar a Excel</button>
                        </div>
                    </nav>

                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">

                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            
                            <div class="row justify-content-center align-items-center">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label"><b>Apellidos y Nombres</b></label>
                                            <input type="text" class="form-control" id="name-filter">
                                        </div>
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label"><b>Módulo Formativo</b></label>
                                            <select class="form-select" id="module-filter">
                                                <option hidden>Módulo Formativo</option>
                                                <option></option>
                                                <option>Profesional/Especialidad</option>
                                                <option>Transversal/Empleabilidad</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label"><b>Período Académico</b></label>
                                            <select class="form-select" id="period-filter">
                                                <option hidden>Período Académico</option>
                                                <option></option>
                                                @foreach($periods as $period)
                                                <option>{{ $period->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label"><b>Turno/Sección</b></label>
                                            <select class="form-select" id="turn-filter">
                                                <option hidden>Turno/Sección</option>
                                                <option></option>
                                                <option>Diurno</option>
                                                <option>Nocturno</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3">
                                            <label class="form-label"><b>Fecha de subida</b></label>
                                            <input type="text" class="form-control date-filter" id="uploaded-filter">
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label class="form-label"><b>Hora de ingreso (fecha)</b></label>
                                            <input type="text" class="form-control date-filter" id="checkin-filter">
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label class="form-label"><b>Hora de salida (fecha)</b></label>
                                            <input type="text" class="form-control date-filter" id="departure-filter">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            
                            <div class="row justify-content-center align-items-center">

                                <div class="col-sm-4">
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-3 col-form-label">
                                            <input class="form-check-input" type="radio" name="export-option" id="by-rank" checked>
                                            <label for="exampleFormControlInput1" class="form-check-label"><b>Por rango</b></label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <a href="#" id="ranks" class="btn btn-primary">.xlsx</a>
                                                <input type="text" class="form-control" id="init-date" value="{{ date('Y-m-d', strtotime('-1 days')) }}" readonly>
                                                <input type="text" class="form-control" id="end-date" value="{{ date('Y-m-d', time()) }}" readonly>
                                                <!--<button type="button" id="export" class="btn btn-primary">Generar</button>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-sm-3 col-form-label">
                                            <input class="form-check-input" type="radio" name="export-option" id="by-day" >
                                            <label for="exampleFormControlInput1" class="form-check-label"><b>Por dia</b></label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <a href="#" id="days" class="btn btn-primary disabled">.xlsx</a>
                                                <input type="text" class="form-control" id="set-day" value="{{ date('Y-m-d', time()) }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-3 col-form-label">
                                            <input class="form-check-input" type="radio" name="export-option" id="by-month" >
                                            <label for="exampleFormControlInput1" class="form-check-label"><b>Por mes</b></label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <a href="#" id="months" class="btn btn-primary disabled">.xlsx</a>
                                                <input type="text" class="form-control" id="set-month" value="{{ date('Y-m', time()) }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-sm-3 col-form-label">
                                            <input class="form-check-input" type="radio" name="export-option" id="by-year" >
                                            <label for="exampleFormControlInput1" class="form-check-label"><b>Por año</b></label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <a href="#" id="years" class="btn btn-primary disabled">.xlsx</a>
                                                <input type="text" class="form-control" id="set-year" value="{{ date('Y', time()) }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>





                  <div class="table-responsive">
                                <table class="table table-hover" id="datat">
                                    <thead class="table-light">
                                        <tr>
                                            <!--<th></th>-->
                                            <th class="input-filter uploaded-col">Fecha de subida</th>
                                            <th class="input-filter name-col">Apellidos y Nombres</th>
                                            <th class="select-module">Módulo Formativo</th>
                                            <th class="select-period">Período Académico</th>
                                            <th class="select-turn">Turno/Sección</th>
                                            {{--<th>Unidad Didáctica</th>--}}
                                            <th class="input-filter checkin-col">Hora de ingreso</th>
                                            <th class="input-filter departure-col">Hora de salida</th>
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
        lengthChange: false,
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
            $(".dt-search").html('');

            this.api()
                .columns('.uploaded-col')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('uploaded-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.name-col')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('name-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.select-module')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('module-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.select-period')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('period-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.select-turn')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('turn-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.checkin-col')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('checkin-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });

            this.api()
                .columns('.departure-col')
                .every(function (index) {
                    let column = this;
                    let title = column.header().textContent;
     
                    let input = document.getElementById('departure-filter');
                    input.placeholder = title;
                    input.setAttribute('data-dt-column', index);

                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });


            /*this.api()
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
                });*/

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

    const datefilters = document.getElementsByClassName('date-filter');
    for (let i = 0; i < datefilters.length; i++)
    {
        new tempusDominus.TempusDominus(datefilters[i], {
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
                  clock: false,
                  decades: false,
                  year: true,
                  month: true,
                  date: true,
                },
            },
            localization: {
                locale: 'en',
                format: "yyyy-MM-dd"
            },
        });
    }

    /*new tempusDominus.TempusDominus(datefilters[1], {
            useCurrent: false,
            stepping: 5,
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
                },
                sideBySide: true,
            },
            localization: {
                locale: 'en',
                format: "yyyy-MM-dd hh:mm T"
            },
        });*/

/******************************************************************************************************************************/
    
    var route = "{{ route('assistance_teacher.export_by_range') }}"+"/";
    $("#ranks").attr("href", route+$('#init-date').val()+"/"+$('#end-date').val());

    var route_date = "{{ route('assistance_teacher.export_by_date') }}"+"/";
    $("#days").attr("href", route_date+$('#set-day').val());
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


    const day = new tempusDominus.TempusDominus(document.getElementById("set-day"), {
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
                //date: false,
                //month: false,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false,
            }
        },
        localization: {
            locale: 'en',
            format: "yyyy-MM-dd"
        },
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

    const subday = day.subscribe(tempusDominus.Namespace.events.change, (e) => {
        $("#days").attr("href", route_date+$('#set-day').val());
    });

    const submonth = month.subscribe(tempusDominus.Namespace.events.change, (e) => {
        $("#months").attr("href", route_date+$('#set-month').val());
    });

    const subyear = year.subscribe(tempusDominus.Namespace.events.change, (e) => {
        $("#years").attr("href", route_date+$('#set-year').val());
    });

    $('input[name="export-option"]').change(function(){
        //alert( "otro" );
        if($('#by-rank').is(':checked'))
        {
            $('#init-date').prop('disabled', false);
            $('#end-date').prop('disabled', false);
            $('#set-day').prop('disabled', true);
            $('#set-month').prop('disabled', true);
            $('#set-year').prop('disabled', true);

            $("#ranks").removeClass("disabled");
            $("#days").addClass("disabled");
            $("#months").addClass("disabled");
            $("#years").addClass("disabled");
        }
        if($('#by-day').is(':checked'))
        {
            $('#init-date').prop('disabled', true);
            $('#end-date').prop('disabled', true);
            $('#set-day').prop('disabled', false);
            $('#set-month').prop('disabled', true);
            $('#set-year').prop('disabled', true);

            $("#ranks").addClass("disabled");
            $("#days").removeClass("disabled");
            $("#months").addClass("disabled");
            $("#years").addClass("disabled");
        }
        if($('#by-month').is(':checked'))
        {
            $('#init-date').prop('disabled', true);
            $('#end-date').prop('disabled', true);
            $('#set-day').prop('disabled', true);
            $('#set-month').prop('disabled', false);
            $('#set-year').prop('disabled', true);

            $("#ranks").addClass("disabled");
            $("#days").addClass("disabled");
            $("#months").removeClass("disabled");
            $("#years").addClass("disabled");
        }
        if($('#by-year').is(':checked'))
        {
            $('#init-date').prop('disabled', true);
            $('#end-date').prop('disabled', true);
            $('#set-day').prop('disabled', true);
            $('#set-month').prop('disabled', true);
            $('#set-year').prop('disabled', false);

            $("#ranks").addClass("disabled");
            $("#days").addClass("disabled");
            $("#months").addClass("disabled");
            $("#years").removeClass("disabled");
        }
    });


/*****************************************************************************************************************************************/

    @if(Session::has('success'))
    toastr.success('<strong>¡Exito!</strong><br>'+'{{ session("success") }}');
    @endif

});
</script>
@endsection