<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function select(Request $request){
        //_token
        $options = "";
        if ($request->isMethod('post')) {

            $datos = $request->all();
            
            $sector = Sector::where('sede_id',$datos['sede'])->get();
            $options .= "<option value=''>Seleccione</option>";
            foreach($sector as $s){
                // Log::info(__METHOD__."::".__LINE__." ::: ".print_r($p->nombre,1));
                $options .= "<option value='".$s->id."'>".$s->nombre."</option>";
            }

            // Log::info(__METHOD__."::".__LINE__." ::: ".print_r($options,1));
            echo $options;
        }
    }
}
