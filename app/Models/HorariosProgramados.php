<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservas;
use App\Models\InsumosOpcional;
use App\Models\DetalleParticipantes;
use App\Models\HorariosProgramados;
use App\Models\DetalleSector;
use Illuminate\Support\Facades\Log;

class HorariosProgramados extends Model
{
    use HasFactory;
    protected $table = 'horarios_programados';

    public function horario(){

        return $this->hasOne('App\Models\Horarios','id','horario_id');
    }


    public function guardardatos($post){

        $reservas = new Reservas();
        $reservas->id_tipoact = $post['tipo_actividad'];
        $reservas->id_usuario = $post['user_id'];
        $reservas->cod_estact = 1;
        $reservas->nom_act = $post['nombre_actividad'];
        $reservas->comen_act = $post['comentario'];
        $reservas->num_person = $post['n_personas'];
        $reservas->fecha_solicitud = date('Y-m-d');
        $reservas->sede_id = $post['sede'];
        $reservas->sector_id = $post['sector'];
        $reservas->save();

        $last_reserva_id = $reservas->id;

        if(isset($post['insumos_opcionales'])){

            foreach($post['insumos_opcionales'] as $io){
                $insumos = new InsumosOpcional();
                $insumos->id_insumo = $io;
                $insumos->id_act = $last_reserva_id;
                $insumos->save();
            }
        }

        if(isset($post['participantes'])){
            foreach($post['participantes'] as $part){
                $participantes = new DetalleParticipantes();
                $participantes->id_act = $last_reserva_id;
                $participantes->idpart = $part;
                $participantes->save();
            }
        }

        if(isset($post['fechas_horas_selected'])){
            $explodehorarios = explode(',',$post['fechas_horas_selected']);
            // Log::info(__METHOD__."::".__LINE__." ::: ".print_r($explodehorarios,1));
            foreach($explodehorarios as $i => $e){
                $hp = new HorariosProgramados();
                $explodehora = explode('_',$e);
                $hp->fecha_unica = $explodehora[0];
                $hp->horario_id = $explodehora[1];
                $hp->id_sector = $post['sector'];
                $hp->id_act = $last_reserva_id;
                $hp->save();
            }
        }

        
        return $reservas;



    }
}
