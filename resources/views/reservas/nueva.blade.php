@extends('layouts.master')
@section('css')
    <!-- <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{ URL::asset('assets/plugins/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ URL::asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <!-- <link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" /> -->
@endsection
    @section('content')
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">Nueva Reserva</h4>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="formulario_reserva" action="{{ route('reserva.nueva') }}" >  
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="sede" class="form-label">Sedes</label>
                                    <select class="form-select" id="sede" name="sede" required>
                                        <option value="">Seleccione</option>
                                        @foreach($sedes as $sede)
                                            @php $selected_s = (old('sede') == $sede->id)?"selected":"" @endphp
                                            <option value="{{$sede->id}}" {{$selected_s}}>{{$sede->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="sector" class="form-label">Sala o dependencia</label>
                                    <select class="form-select" id="sector" name="sector" required>
                                        <option value="">--Seleccione--</option>
                                    <?php //while($line_sector = mysql_fetch_array($result_sector, MYSQL_ASSOC)){?>
                                        <!--<option value="<?php //echo $line_sector['id_sector']?>"><?php //echo utf8_encode($line_sector['nom_sector'])?></option>-->
                                    <?php //}?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4"> 
                                    <label for="tipo_actividad" class="form-label">Motivo actividad</label>
                                    <select class="form-select" id="tipo_actividad" name="tipo_actividad" required>
                                        <option value="">Seleccione</option>
                                        @foreach($tipo_actividad as $ta)
                                            @php $selected_ta = (old('tipo_actividad') == $ta->id)?"selected":"" @endphp
                                            <option value="{{$ta->id}}" {{$selected_ta}}>{{$ta->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4"> 
                                    <label for="nombre_actividad" class="form-label">Nombre Oficial Actividad</label>
                                    <input class="form-control" id="nombre_actividad" name="nombre_actividad" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="n_personas" class="form-label">N° Personas</label>
                                    <input class="form-control" id="n_personas" name="n_personas" required/>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="comentario" class="form-label">Comentario</label>
                                    <textarea class="form-control" rows="3" id="comentario" name="comentario"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="participantes" class="form-label">Participantes</label>
                                    <select class="form-control" name="participantes[]" id=participantes  size="8" multiple="multiple" required>
                                        @foreach($participantes as $p)
                                            <option value="{{$p->id}}">{{$p->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="participantes" class="form-label">Tipo de Insumos</label>
                                    <select class="form-control" id="tipo_insumo" name="tipo_insumo" required>
                                        <option value="">Seleccione</option>
                                        @foreach($tipo_insumo as $ti)
                                            @php $selected_ti = (old('tipo_insumo') == $ti->id)?"selected":"" @endphp
                                            <option value="{{$ti->id}}" {{$selected_ti}}>{{$ti->nombre}}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="col-md-4">
                                    <label for="participantes" class="form-label">Insumos</label>
                                    <select name="insumos[]" id="insumos" class="form-control" size="8" multiple="multiple">
                                        <?php //while($line_insumo = mysql_fetch_array($result_insumo, MYSQL_ASSOC)){?>
                                            <!-- <option value="<?php //echo $line_insumo['id_insumo']?>"><?php //echo utf8_encode($line_insumo['nom_insumo'])?></option>-->
                                        <?php //}?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="calendario" class="form-label">Calendario</label>
                                    <!-- <div id="calendario"></div>  -->
                                    <input class="form-control" id="calendario" name="calendario">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div id="cargando">
                                        <i class="la la-spinner text-primary la-spin progress-icon-spin"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_horas"></div>
                                    <input type="hidden" id="fechas_horas_selected" name="fechas_horas_selected" />
                                </div>
                            </div>                          
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" onClick="rescatar_check();" id="btn_enviar">Enviar Reserva</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@section('script')
<script>
     $(document).ready( function () {

        $("#tipo_insumo").on('change', function () {
            tipoinsumo = $("#tipo_insumo").val();
            token = "<?php echo csrf_token();?>";
            // console.log("TIPOINSUMO:: "+ tipoinsumo);
            $.post("<?php echo url('insumos/select') ?>", { tipoinsumo: tipoinsumo, _token: token }, function(data){
                // console.log(data)
                $("#insumos").html(data);
            });    
        });

        $("#sede").on('change', function () {
            sede = $("#sede").val();
            token = "<?php echo csrf_token();?>";
            console.log("SECTOR:: "+ sede);
            $.post("<?php echo url('sector/select') ?>", { sede: sede, _token: token }, function(data){
                // console.log(data)
                $("#sector").html(data);
            });    
        });

        $('#calendario').datepicker({
            onSelect: function(date) {
                mostrar_horarios(date);
            },
            firstDay: 1,
            minDate: +1,
            dateFormat: 'yy-mm-dd',
            maxDate: new Date('2050-01-01')
        });
        
        $('#cargando').hide();

        $("button#btn_enviar").click(function(){
            var sede = $('#sede').val();
            var sector = $('#sector').val();
            var tipo_actividad = $('#tipo_actividad').val();
            var nombre_actividad = $('#nombre_actividad').val();
            var n_personas = $('#n_personas').val();
            var to_part = $('#to_part').val();
            var horas = $('#fechas_horas_selected').val();

            $.blockUI({ message: '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Espere un momento</div></div>' });
            if(sede == ''){
                $.unblockUI();
                alert("Debe ingresar sede");
                $('#sede').focus();
            }else if(sector == ''){
                $.unblockUI();
                alert("Debe ingresar Sala o dependencia");
                $('#sector').focus();
            }else if(tipo_actividad == ''){
                $.unblockUI();
                alert("Debe ingresar Motivo actividad");
                $('#tipo_actividad').focus();
            }else if(nombre_actividad == ''){
                $.unblockUI();
                alert("Debe ingresar Nombre oficial actividad");
                $('#nombre_actividad').focus();
            }else if(n_personas == ''){
                $.unblockUI();
                alert("Debe ingresar N° Personas");
                $('#n_personas').focus();
            }else if(to_part == ''){
                $.unblockUI();
                alert("Debe ingresar Participantes");
                $('#to_part').focus();
            }else if(horas == ',--Seleccione--'){
                $.unblockUI();
                alert("Debe ingresar Horas en el calendario");
            }else if(horas == ''){
                $.unblockUI();
                alert("Debe ingresar una fecha en el calendario");
            }else{
                //cargando
                $.blockUI({ message: '<img src="../img/default.gif" /> Espere un momento...' });

                    var participantes = []
                    $.map($('#participantes option') ,function(option) {
                        participantes.push(option.value);
                    });

                    var insumos_opcionales = []
                    $.map($('#insumos option') ,function(option) {
                        insumos_opcionales.push(option.value);
                    });

                    my_data = $('#formulario_reserva').serialize();
                    console.log("TEST :::" + $('#sede').val());
                    var url = "<?php echo url('reservar/guardar'); ?>";
                    var token = "<?php echo csrf_token();?>";
                    $.post( url, { 'participantes[]': $('#participantes').val(),
                                    'insumos_opcionales[]': $('#insumos').val(),
                                    'sede': $('#sede').val(),
                                    'sector': $('#sector').val(),
                                    'tipo_actividad': $('#tipo_actividad').val(),
                                    'nombre_actividad': $('#nombre_actividad').val(),
                                    'n_personas': $('#n_personas').val(),
                                    'comentario': $('#comentario').val(),
                                    'ins_op': $('#ins_op').val(),
                                    'fechas_horas_selected': $('#fechas_horas_selected').val(),
                                    'fecha_fin_diario' : $('#fecha_fin_diario_id').val(),
                                    'fecha_fin_semana' : $('#fecha_fin_semana_id').val(),
                                    'fecha_fin_mensual' : $('#fecha_fin_mensual_id').val(),
                                    'periodicidad' : $('#periodicidad').val(),
                                    'user_id': $('#user_id').val(),
                                    // 'semana_mes' : $('#semana_mes').val(),
                                    // 'semana_lunes' : $('#semana_lunes').is(':checked'),
                                    // 'semana_martes' : $('#semana_martes').is(':checked'),
                                    // 'semana_miercoles' : $('#semana_miercoles').is(':checked'),
                                    // 'semana_jueves' : $('#semana_jueves').is(':checked'),
                                    // 'semana_viernes' : $('#semana_viernes').is(':checked'),
                                    // 'semana_sabado' : $('#semana_sabado').is(':checked'),
                                    // 'semana_domingo' : $('#semana_domingo').is(':checked'),
                                    '_token': token
                                })
                    .done(function( data ) {
                        $.unblockUI();
                        //console.log(data);
                         window.location.href = '<?php echo url("home"); ?>';
                    })
                    .fail(function() {
                        alert("Fallo al momento de generar la aprobación, por favor contactese con el administrador del sistema");
                        location.reload(true);
                    });
            }

        });
    });


    function mostrar_horarios(date){
        $("#sector").val();
            if($("#sector").val() != ''){
                var id_sector = $('#sector').val();
                var token = "<?php echo csrf_token();?>";
                $('#cargando').show();
                $('#div_horas').html('');
                // $('#div_horas').load('horario.php?fecha='+date+'&id_sector='+id_sector, function(response, status, xhr){
                    $('#div_horas').load('<?php echo url('horarios/horario') ?>',{fecha:date, id_sector:id_sector,  _token: token}, function(response, status, xhr){
                    if(status=='success'){
                        $('#cargando').hide();
                    }
                });
            }else{
                alert('Debe seleccionar Sala o Dependencia');
            }
    }

    function rescatar_check() {
            var columns = [];
            $('#div_horas :checked').each(function () {
                columns.push($(this).val());
            });
            $('#fechas_horas_selected').val(columns);
        }

</script>
    <script src="{{ URL::asset('assets/js/jquery.blockUI.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/plugins/huebee/huebee.pkgd.min.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('assets/js/pages/jquery.forms-advanced.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('assets/js/app.js') }}"></script> -->
@endsection