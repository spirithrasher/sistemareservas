<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleParticipantes extends Model
{
    use HasFactory;
    protected $table = 'detalle_part';

    public function participantes(){

        return $this->hasOne('App\Models\Participantes','id','idpart');
    }
}
