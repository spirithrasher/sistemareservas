<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    protected $table = 'actividad';

    public function sede(){

        return $this->hasOne('App\Models\Sedes','id','sede_id');
    }

    public function sector(){

        return $this->hasOne('App\Models\Sector','id','sector_id');
    }

    public function estado(){

        return $this->hasOne('App\Models\Estados','id','cod_estact');
    }

    public function solicitante(){

        return $this->hasOne('App\Models\User','id','id_usuario');
    }

    public function horariosprogramados(){
        return $this->hasMany('App\Models\HorariosProgramados','id_act', 'id');
    }

    public function detalleparticipantes(){
        return $this->hasMany('App\Models\DetalleParticipantes','id_act', 'id');
    }

    public function insumosopcionales(){
        return $this->hasMany('App\Models\InsumosOpcional','id_act', 'id');
    }

    public function aprobadores(){

        return $this->hasOne('App\Models\Aprobadores','id','sede_id');
    }

    public function notificacion(){

        return $this->hasOne('App\Models\Notificaciones','id','id_act');
    }
}
