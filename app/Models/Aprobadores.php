<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprobadores extends Model
{
    use HasFactory;
    protected $table = 'aprobadores';

    public function aprobador(){

        return $this->hasOne('App\Models\User','id','user_id');
    }
}
