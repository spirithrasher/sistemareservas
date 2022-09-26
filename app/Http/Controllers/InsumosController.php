<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumos;
use Illuminate\Support\Facades\Log;

class InsumosController extends Controller
{
    public function select(Request $request){
        //_token
        $options = "";
        if ($request->isMethod('post')) {

            $datos = $request->all();
            
            $insumos = Insumos::where('tipo_insumo_id',$datos['tipoinsumo'])->get();
            // $options .= "<option value=''>Seleccione</option>";
            foreach($insumos as $i){
                // Log::info(__METHOD__."::".__LINE__." ::: ".print_r($p->nombre,1));
                $options .= "<option value='".$i->id."'>".$i->nombre."</option>";
            }

            // Log::info(__METHOD__."::".__LINE__." ::: ".print_r($options,1));
            echo $options;
        }
    }
}
