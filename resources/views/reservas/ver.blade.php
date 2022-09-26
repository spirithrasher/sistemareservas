@extends('layouts.master')
    @section('content')
    
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">Reserva Solicitada</h4>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Estado Solicitud:</strong></label>
                                <p class="mt-2">{{ $reserva->estado->nombre}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <label><strong>N° Solicitud:</strong></label>
                                <p class="mt-2">{{ $reserva->id}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <label><strong>Solicitante:</strong></label>
                                <p class="mt-2">{{ $reserva->solicitante->name}}</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Fecha solicitud:</strong></label>
                                <p class="mt-2">{{ $reserva->fecha_solicitud}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <label><strong>Sede:</strong></label>
                                <p class="mt-2">{{ $reserva->sede->nombre}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <label><strong>Sala o dependencia:</strong></label>
                                <p class="mt-2">{{ $reserva->sector->nombre }}</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Nombre Actividad:</strong></label>
                                <p class="mt-2">{{ $reserva->nom_act}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <label><strong>N° Asistentes:</strong></label>
                                <p class="mt-2">{{ $reserva->num_person}}</p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>Comentario:</strong></label>
                                <p class="mt-2">{{ $reserva->comen_act}}</p>
                                <hr>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label><strong>Fechas Reservadas:</strong></label>
                                @php $fechas = fechadesdehasta($reserva->id) @endphp
                                <table class="table table-bordered mt-3">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $fechas as $fecha => $hora)
                                            <tr>
                                                <td>{{ $fecha }}</td>
                                                <td>{{ $hora['hora_inicio'] }}</td>
                                                <td>{{ $hora['hora_fin'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Participantes:</strong></label>
                                <table class="table table-bordered mt-3">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Participantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $reserva->detalleparticipantes as $dp) 
                                            <tr>
                                                <td>{{ $dp->participantes->nombre }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label><strong>Insumos Opcionales:</strong></label>
                                <table class="table table-bordered mt-3">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Insumos Opcionales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $reserva->insumosopcionales as $io) 
                                            <tr>
                                                <td>{{ $io->insumo->nombre }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card border-dark mt-3" >
                            <div class="card-header fs-4 text-white bg-info">Información para Aprobador</div>
                            <div class="card-body">
                                @php $puedoaprobador = puedoaprobador(Auth::user()->id,$reserva->sede_id);@endphp
                                @php $disabledsoyaprobador = (!$puedoaprobador)?"disabled":""; @endphp
                                <form class="aprueba_solicitud_form" >  
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><strong>Aprobador:</strong></label>
                                            <p class="mt-2">{{ $reserva->aprobadores->aprobador->name}}</p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="estado_solicitud" class="form-label"><strong>Estado Solicitud:</strong></label>
                                            <select class="form-select" id="estado_solicitud" name="estado_solicitud" {{$disabledsoyaprobador}}>
                                                @foreach($estados as $e)
                                                    @php $selected_e = (old('estado_solicitud') == $e->id)?"selected":($reserva->cod_estact == $e->id)?"selected":""; @endphp
                                                    <option value="{{$e->id}}" {{$selected_e}}>{{$e->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="comentario_aprobador" class="form-label"><strong>Comentario:</strong></label>
                                            @php $comentarioaprobador = (old('comentario_aprobador'))?old('comentario_aprobador'):(isset($reserva->notificacion->glosa))?$reserva->notificacion->glosa:""; @endphp
                                            <textarea class="form-control" rows="3" id="comentario_aprobador" name="comentario_aprobador" {{$disabledsoyaprobador}}></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            @if($puedoaprobador)
                                                <button type="button" class="btn btn-primary" id="btn_aprobador" name="btn_aprobador">Confirmar Reserva</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="modal fade" id="modalmensajes" tabindex="-1" aria-labelledby="modalmensajesLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalmensajesLabel">Alerta!</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closemodal" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    @endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
    $(document).ready(function () {

        $("button#btn_aprobador").click(function(){
            var estado_solicitud = $('#estado_solicitud').val();
            var comentario = $('#comentario_aprobador').val();
            if(estado_solicitud == 1){
                // alert('Debe seleccionar estado');
                // $("#modalestadopendiente").modal('show');
                $('.modal-body').append('<h4>Debe seleccionar el estado de la solicitud</h4>');
                $('#modalmensajes').modal('show');
                $("#closemodal").click(function() {        
                    $('#estado_solicitud').focus();
                    $('.modal-body').empty();
                });
            }else{
                if(estado_solicitud==3 && comentario == ""){
                    $('.modal-body').append('<h4>Debe ingresar un comentario</h4>');
                    $('#modalmensajes').modal('show');
                    $("#closemodal").click(function() {        
                        $('#comentario').focus();
                        $('.modal-body').empty();
                    });
                }else{
                    //cerramos el modal
                    // $('#myModal').modal('hide');
                    //cargando
                    $.blockUI({ message: '<img src="../img/default.gif" /> Espere un momento...' });
                    
                    my_data = $('#aprueba_solicitud_form').serialize();
                    
                    var url = "<?php echo url('reservar/aprobador').'/'.$reserva->id; ?>";
                    console.log("TEST :::" + url);
                    
                    var token = "<?php echo csrf_token();?>";
                    $.post( url, { 'estado_solicitud': $('#estado_solicitud').val(),
                                    'comentario_aprobador': $('#comentario_aprobador').val(),
                                    '_token': token
                                })
                    .done(function( data ) {
                        $.unblockUI();
                        //console.log(data);
                            window.location.href = '<?php echo url("home"); ?>';
                    })
                    .fail(function() {
                        alert("Fallo al momento de generar la aprobación, por favor contactese con el administrador del sistema");
                        // location.reload(true);
                    });
                }

            }
        });
    });
</script>
<script src="{{ URL::asset('assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
