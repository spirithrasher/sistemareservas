<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsumosOpcional extends Model
{
    use HasFactory;
    protected $table = 'insumo_opcional';

    public function insumo(){

        return $this->hasOne('App\Models\Insumos','id','id_insumo');
    }
}
