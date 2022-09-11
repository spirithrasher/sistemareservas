<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';

    public function guardar($post,$idactividad,$aprobador){

        $this->glosa = (isset($post['comentario_aprobador']))?$post['comentario_aprobador']:NULL;
        $this->fecha_revisado = date('Y-m-d');
        $this->id_apro = $aprobador->id;
        $this->id_act = $idactividad;
        $this->codestact = $post['estado_solicitud'];
        $this->save();
    }
}
