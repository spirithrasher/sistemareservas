<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Horarios;

class HorariosController extends Controller
{
    public function horario(Request $request){

        $fechatabla = array();
        $post = $request->all();
        $fechaseleccionada = $post['fecha'];

        $fecha_mas_1 = strtotime ( '+0 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_1 = date ( 'Y-m-d' , $fecha_mas_1 );
        $fechastabla['fecha_mas_1'] = $fecha_mas_1;

        $fecha_mas_2 = strtotime ( '+1 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_2 = date ( 'Y-m-d' , $fecha_mas_2 );
        $fechastabla['fecha_mas_2'] = $fecha_mas_2;

        $fecha_mas_3 = strtotime ( '+2 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_3 = date ( 'Y-m-d' , $fecha_mas_3 );
        $fechastabla['fecha_mas_3'] = $fecha_mas_3;

        $fecha_mas_4 = strtotime ( '+3 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_4 = date ( 'Y-m-d' , $fecha_mas_4 );
        $fechastabla['fecha_mas_4'] = $fecha_mas_4;

        $fecha_mas_5 = strtotime ( '+4 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_5 = date ( 'Y-m-d' , $fecha_mas_5 );
        $fechastabla['fecha_mas_5'] = $fecha_mas_5;

        $fecha_mas_6 = strtotime ( '+5 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_6 = date ( 'Y-m-d' , $fecha_mas_6 );
        $fechastabla['fecha_mas_6'] = $fecha_mas_6;

        $fecha_mas_7 = strtotime ( '+6 day' , strtotime ( $fechaseleccionada ) ) ;
        $fecha_mas_7 = date ( 'Y-m-d' , $fecha_mas_7 );
        $fechastabla['fecha_mas_7'] = $fecha_mas_7;

        $horarios = Horarios::all();
        
        return view('horarios/horario')
                ->with('fechastabla',$fechastabla)
                ->with('post',$post)
                ->with('horarios',$horarios);
    }
}
