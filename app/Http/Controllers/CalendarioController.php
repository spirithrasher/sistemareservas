<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class CalendarioController extends Controller
{
    public function index(Request $request){

        $data = array();
        $reservas = Reservas::all();
        foreach($reservas as $r ){
            foreach($r->horariosprogramados as $hp){
                $data[] = array(
                    'title' => $r->nom_act,
                    'start' =>  $hp->fecha_unica,
                    'className' => 'bg-soft-primary',
                );
            }
            
            // $finicio = $r->horariosprogramados->fecha_unica;
            // $hora = $r->horariosprogramados->horario->hora_inicio;
            
        }

        $json = json_encode($data);
        
        return view('calendario/index')
            ->with('eventos',$json);
    }
}
