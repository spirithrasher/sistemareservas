<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sedes;
use App\Models\TipoActividad;
use App\Models\Participantes;
use App\Models\TipoInsumo;
use App\Models\HorariosProgramados;
use App\Models\Reservas;
use App\Models\Estados;
use App\Models\Notificaciones;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaAprobada;
use App\Mail\ReservaRechazada;
use App\Mail\NuevaReserva;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ReservasController extends Controller
{

    public function listado(Request $request){
        
        if ($request->ajax()) {
            
            $data = Reservas::select('id','id_tipoact','id_usuario','cod_estact','nom_act','comen_act','num_person','fecha_solicitud','sede_id','sector_id')
                        ->get();
    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                       
                        $btn = '<a class="btn btn-outline-success" href="'.route("reservar.ver",["id" => $row->id ]).'" role="button">Ver <i class="fas fa-search"></i></a> ';
                        // $btn .= '<a class="btn btn-outline-danger" href="#" role="button">DesHabilitar</a> ';
                        
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }

        return view('reservas/listado');
    }

    public function nueva(Request $request){

        $sedes = Sedes::all();
        $tipo_actividad = TipoActividad::all();
        $participantes = Participantes::all();
        $tipo_insumo = TipoInsumo::all();
        return view('reservas/nueva')
                ->with('sedes',$sedes)
                ->with('tipo_insumo',$tipo_insumo)
                ->with('participantes',$participantes)
                ->with('tipo_actividad',$tipo_actividad);
    }

    public function guardar(Request $request){

        $post = $request->all();
        $horarioprogramado = new HorariosProgramados();
        Log::info(__METHOD__."::".__LINE__." ::: ".print_r($post,1));
        $reserva = $horarioprogramado->guardardatos($post);

        Mail::to($reserva->aprobadores->aprobador->email)
            ->send(new NuevaReserva($reserva));

        return redirect()->route('home')
                ->with('success','Reserva creada correctamente.');

    }

    public function ver(Request $request, $id = NULL){
        
        $reserva = Reservas::find($id);
        $estados = Estados::all();
        $reserva = Reservas::find($id);
        return view('reservas/ver')
                ->with('reserva',$reserva)
                ->with('estados',$estados);
    }

    public function verbuscador(Request $request, $id = NULL){
        
        $reserva = Reservas::find($id);
        $estados = Estados::all();
        $reserva = Reservas::find($id);
        return view('reservas/verbuscador')
                ->with('reserva',$reserva)
                ->with('estados',$estados);
    }

    public function aprobador(Request $request, $id = NULL){
        Log::info(__METHOD__."::".__LINE__." ::: ".print_r($request->all(),1));
        $reserva = Reservas::find($id);
        $post = $request->all();
        $aprobador = Auth::user();
        $n = Notificaciones::where('id_act','=',$id)->first();
        if(isset($n->id)){
            $notificacion = Notificaciones::find($n->id);
        }else{
            $notificacion = new Notificaciones();
        }
        
        $notificacion->guardar($post,$id,$aprobador);
        
        $reserva->cod_estact = $post['estado_solicitud'];
        $reserva->save();

        if($reserva->cod_estact == 2){
            Mail::to($reserva->solicitante->email)
            ->send(new ReservaAprobada($reserva));
        }

        if($reserva->cod_estact == 3){
            Mail::to($reserva->solicitante->email)
                ->send(new ReservaRechazada($reserva));
        }

    }
}
