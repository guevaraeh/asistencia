@extends('layout')

@section('title')
<title>Crear Asistencia</title>
@endsection

@section('content')
<div class="container">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="card-title text-primary">Crear Asistencia</h5>
                </div>
                <form action="{{ route('assistance_teacher.confirm') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Apellidos y Nombres</b><font color="red">*</font></label>
                          @if(isset($tch))
                          <input type="hidden" name="teacher-id" value="{{ $tch->id }}"><br>{{ $tch->lastname . ' ' . $tch->name }}
                          @else
                          <select class="form-select selectto" aria-label="Default select example" name="teacher-id" id="teacher-id" required>
                            <option selected disabled value="">--Seleccione profesor--</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->lastname . ' ' . $teacher->name }}</option>
                            @endforeach
                          </select>
                          @endif
                      </div>
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Módulo Formativo</b><font color="red">*</font></label>
                          <select class="form-select" aria-label="Default select example" name="training-module" id="training-module" required>
                            <option selected disabled value="">--Seleccione--</option>
                            <option value="Profesional/Especialidad">Profesional/Especialidad</option>
                            <option value="Transversal/Empleabilidad">Transversal/Empleabilidad</option>
                          </select>
                      </div>
                    </div>

                        <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Periodo Académico</b><font color="red">*</font></label>
                          <select class="form-select" aria-label="Default select example" name="period" id="period" required>
                            <option selected disabled value="">--Seleccione--</option>
                            {{--
                            <option value="Segundo">Segundo</option>
                            <option value="Cuarto">Cuarto</option>
                            <option value="Sexto">Sexto</option>
                            --}}
                            @foreach($periods as $period)
                            <option value="{{ $period->name }}">{{ $period->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Turno/Sección</b><font color="red">*</font></label>
                          <select class="form-select" aria-label="Default select example" name="turn" id="turn" required>
                            <option selected disabled value="">--Seleccione--</option>
                            <option value="Diurno">Diurno</option>
                            <option value="Nocturno">Nocturno</option>
                          </select>
                      </div>
                      </div>

                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"><b>Unidad Didáctica</b><font color="red">*</font></label>
                      <textarea class="form-control" id="validationCustom01" name="didactic-unit" id="didactic-unit" required></textarea>
                    </div>

                        <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Hora de ingreso a clase</b><font color="red">*</font></label>
                          <input type="text" class="form-control timepicker1" name="checkin-time" id="checkin-time" 
                            {{--value="{{ date('Y-m-d H:i', time()) }}"--}}
                            value="{{ date('Y-m-d h:i A', time()) }}"
                          readonly required>
                            @error('checkin-time')
                            <div class="invalid-feedback">Fecha y hora inválidos.</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label"><b>Hora de salida de clase</b><font color="red">*</font></label>
                          <input type="text" class="form-control timepicker2" name="departure-time" id="departure-time" 
                            {{--value="{{ date('Y-m-d H:i', strtotime('+3 hour')) }}"--}} 
                            value="{{ date('Y-m-d h:i A', strtotime('+3 hour')) }}"
                          readonly required>
                            @error('departure-time')
                            <div class="invalid-feedback">Fecha y hora inválidos.</div>
                            @enderror
                        </div>
                        </div>

                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"><b>Tema de actividad de aprendizaje</b><font color="red">*</font></label>
                      <input type="text" class="form-control" name="theme" id="theme" required>
                        @error('theme')
                        <div class="invalid-feedback">Incorrecto.</div>
                        @enderror
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Lugar de realización de actividad</b><font color="red">*</font></label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="place" value="Aula" checked>
                        <label class="form-check-label" for="flexRadioDefault1">Aula</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="place" value="Laboratorio">
                        <label class="form-check-label" for="flexRadioDefault2">Laboratorio</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="place" value="Taller">
                        <label class="form-check-label" for="flexRadioDefault2">Taller</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="place" value="" id="another-place">
                        <label class="form-check-label" for="flexRadioDefault2">Otros</label>
                        <input type="text" class="form-control" id="ap" disabled>
                      </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Plataformas educativas de apoyo</b></label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="educational-platforms[]" value="Moodle Institucional" checked>
                        <label class="form-check-label" for="flexCheckDefault">Moodle Institucional</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="educational-platforms[]" value="Google Meet">
                        <label class="form-check-label" for="flexCheckChecked">Google Meet</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="educational-platforms[]" value="Skipe">
                        <label class="form-check-label" for="flexCheckChecked">Skipe</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="educational-platforms[]" id="another-platform" value="">
                        <label class="form-check-label" for="flexCheckChecked">Otros</label>
                        <input type="text" class="form-control" id="apf" disabled>
                      </div>
                    </div>
                    </div>

                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"><b>Observaciones</b></label>
                      <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                  
                </div>
                <div class="card-footer py-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    @can('manage-assistance')
                    <a href="{{ route('assistance_teacher') }}" class="btn btn-danger">Cancelar</a>
                    @endcan
                </div>
                </form>
              </div>
            </div>
</div>
@endsection

@section('javascript')

<script>
$( document ).ready(function() {
    
    $('input[name="place"]').change(function(){
        //alert( "otro" );
        if($('#another-place').is(':checked'))
        {
            $('#ap').prop('disabled', false);
            $('#ap').prop('required', true);
        }
        else
        {
            $('#ap').prop('required', false);
            $('#ap').prop('disabled', true);
        }
    });

    $('#ap').change(function() {
        $("#another-place").val($(this).val());
    });


    $('input[name="educational-platforms[]"]').change(function(){
        //alert( "otro" );
        if($('#another-platform').is(':checked'))
        {
            $('#apf').prop('disabled', false);
            $('#apf').prop('required', true);
        }
        else
        {
            $('#apf').prop('required', false);
            $('#apf').prop('disabled', true);
        }
    });

    $('#apf').change(function() {
        $("#another-platform").val($(this).val());
    });


    /*************************************************************************************************************/

    //https://preview.keenthemes.com/html/start-html-pro/docs/forms/tempus-dominus-datepicker
    const linkedPicker1Element = document.getElementById("checkin-time");
    const linked1 = new tempusDominus.TempusDominus(linkedPicker1Element, {
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
            sideBySide: true,
        },
      localization: {
            locale: 'en',
            hourCycle: 'h12',
            format: "yyyy-MM-dd hh:mm T"
        },
      restrictions: {
            maxDate: document.getElementById("departure-time").value,
        }
    });
    const linked2 = new tempusDominus.TempusDominus(document.getElementById("departure-time"), {
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
            sideBySide: true,
        },
        localization: {
            locale: 'en',
            hourCycle: 'h12',
            format: "yyyy-MM-dd hh:mm T"
        },
        restrictions: {
            minDate: document.getElementById("checkin-time").value,
        }
    });

    linkedPicker1Element.addEventListener(tempusDominus.Namespace.events.change, (e) => {
        linked2.updateOptions({
            restrictions: {
            minDate: e.detail.date,
            },
        });
    });

    const subscription = linked2.subscribe(tempusDominus.Namespace.events.change, (e) => {
        linked1.updateOptions({
            restrictions: {
            maxDate: e.date,
            },
        });
    });

    /******************************************************************************************************/

    /*$(".data-assistance").change(function(){
        $.ajax({
            method: "POST",
            url: "/ruta", 
            data: {
                teacher_id: $('#teacher-id').val(),,
                training_module: $('#training-module').val(),
                period: $('#period').val(),
                turn: $('#turn').val(),
                didactic_unit: $('#didactic-unit').val(),
                checkin_time: $('#checkin-time').val(),
                departure_time: $('#departure-time').val(),
                theme: $('#theme').val(),
                place: $('input[name="place"]').val(),
                educational_platforms: $('input[name="educational-platforms[]"]').val(),
                remarks: $('#remarks').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(result){
                $("#block-comment").html('Enviado');
                //console.log(result);
            }
        });
    });*/

    /******************************************************************************************************/

    $('.selectto').select2({
      language: 'es',
      theme: 'bootstrap-5'
    });

    

    @if ($errors->any()) 
        @error('checkin-time')
            toastr.error('<strong>¡Error!</strong><br> Hora de ingreso a clase incorrecto.');
        @enderror
        @error('departure-time')
            toastr.error('<strong>¡Error!</strong><br> Hora de salida a clase incorrecto.');
        @enderror
        @error('theme')
            toastr.error('<strong>¡Error!</strong><br> Tema mal redactado.');
        @enderror
    @endif


});


</script>

@endsection