<?php 
use App\Models\HorariosProgramados;
use App\Models\DetalleParticipantes;
use App\Models\Aprobadores;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

function saber_dia($nombredia) {
	$dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
	$fecha = $dias[date('N', strtotime($nombredia))];
 	
 	return $fecha;
}

function horariosprogramados($horario_id,$fecha_unica,$sector_id){

	$dato = HorariosProgramados::where('horario_id','=',$horario_id)
					->where('fecha_unica','=',$fecha_unica)
					->where('id_sector','=',$sector_id)
					->get()->count();

	if($dato > 0){
		return true;
	}else{
		return false;
	}
}


function fechainicioactividad($idactividad){

	$datos = HorariosProgramados::where('id_act','=',$idactividad)->first();

	if(isset($datos->fecha_unica)){
		return $datos->fecha_unica;
	}else{
		return '-';
	}
}


function fechadesdehasta($idactividad){

	$fechas = array();
	$datos = HorariosProgramados::where('id_act','=',$idactividad)->get();

	foreach($datos as $d){
		$fechas[$d->fecha_unica]['hora_inicio'] = $d->horario->hora_inicio;
		$fechas[$d->fecha_unica]['hora_fin'] = $d->horario->hora_fin;
	}

	Log::info(__METHOD__."::".__LINE__." ::: ".print_r($fechas,1));
	return $fechas;
}


function puedoaprobador($user_id, $sede_id){

	$datos = Aprobadores::where('user_id','=',$user_id)
				->where('sede_id','=',$sede_id)
				->get()
				->count();
	
	if($datos > 0){
		return true;
	}else{
		return false;
	}
}

function soyaprobador(){
	$datos = Aprobadores::where('user_id','=',Auth::user()->id);
	
	if($datos->get()->count() > 0){
		return $datos->first();
	}else{
		return false;
	}
}