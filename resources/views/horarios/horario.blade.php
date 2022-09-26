
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">    
            <div class="card border-dark" >
                <div class="card-header fs-4 text-white bg-info">Horarios</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <th>Hora Inicio</th>
                            <th>Hora Término</th>
                            <th><?php echo $fechastabla['fecha_mas_1'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_2'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_3'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_4'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_5'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_6'] ?></th>
                            <th><?php echo $fechastabla['fecha_mas_7'] ?></th>
                        </thead>
                        <tbody>

                            @foreach($horarios as $h)
                                <tr>
                                    <td>{{ $h->hora_inicio}}</td>
                                    <td>{{ $h->hora_fin}}</td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_1'],$post['id_sector'] ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_1']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_1']}}_{{$h->id}}" disabled/>    
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_1']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_1']}}_{{$h->id}}" />                                        
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_2'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_2']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_2']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_2']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_2']}}_{{$h->id}}" />
                                        @endif
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_3'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_3']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_3']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_3']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_3']}}_{{$h->id}}" />
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_4'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_4']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_4']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_4']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_4']}}_{{$h->id}}" />
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_5'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_5']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_5']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_5']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_5']}}_{{$h->id}}" />
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_6'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_6']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_6']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_6']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_6']}}_{{$h->id}}" />
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if(horariosprogramados($h->id,$fechastabla['fecha_mas_7'],$post['id_sector']  ))
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_7']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_7']}}_{{$h->id}}" disabled/>
                                        @else
                                            <input type="checkbox" id="{{$fechastabla['fecha_mas_7']}}_{{$h->id}}" value="{{$fechastabla['fecha_mas_7']}}_{{$h->id}}" />
                                        @endif
                                        
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