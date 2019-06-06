<?php

namespace App\Http\Controllers\Maestro;

use App\Carreras;
use App\Grupo;
use App\Maestro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GruposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maestro');
    }

    public function index(){
        $maestro = Maestro::where('id_user','=',auth()->user()->id)->first();
        return view('maestro.grupos.index',['maestro'=>json_encode($maestro)]);
    }

    public function gruposPorInstitucion($id_insitucion, $id_maestro){
//        $grupos = Grupo::where('id_institucion','=',$id_insitucion)->where('id_maestro','=',$id_maestro)->get();
        $grupos = DB::table('grupo')
            ->join('carrera','grupo.id_carrera','=','carrera.id')
            ->where('id_institucion','=',$id_insitucion)
            ->where('id_maestro','=',$id_maestro)
            ->select(['grupo.*','carrera.nombre as carrera'])
            ->get();
        return response()->json($grupos);
    }

    public function getCarreras(){
        $carreras = Carreras::where('deleted','=',0)->get();
//        dd('entra');
        return response()->json(['carreras'=>$carreras]);
    }

    public function editarCarrera(Request $request){
//        return response()->json($request->id);
        $grupo = Grupo::findOrFail($request->id);
        if(isset($grupo)){
            $validations = [
                'grado'=>'required|numeric|min:1',
                'grupo'=>'required|alpha|min:1',
                'generacion_inicio'=>'required|numeric',
                'generacion_fin'=>'required|numeric',
                'turno'=>'required|alpha|min:1',
                'id_carrera'=>'required|numeric|min:1'
            ];

            $validator = Validator::make($request->all(),$validations,[
                'grado.required'=>'Ingrese el grado del grupo',
                'grado.numeric'=>'Ingrese un valor númerico como grado',
                'grado.min'=>'Ingrese valores mayores a cero',
                'grupo.required'=>'Ingrese el grado del grupo',
                'grupo.alpha'=>'Ingrese una letra como para diferenciar al grupo',
                'grupo.min'=>'Ingrese valores mayores a cero',
                'generacion_inicio.required'=>'Ingrese el año de inicio de la generación',
                'generacion_inicio.numeric'=>'Ingrese un valor númerico como grado año de inicio de la generación',
                'generacion_fin.required'=>'Ingrese el año de fin de la generación',
                'generacion_fin.numeric'=>'Ingrese un valor númerico como grado año de fin de la generación',
                'turno.required'=>'Ingrese el turno del grupo',
                'turno.alpha'=>'Ingrese una letra como turno',
                'turno.min'=>'Ingrese solo un caracter como turno',
                'id_carrera.required'=>'Seleccione una carrera',
                'id_carrera.numeric'=>'Seleccione una carrera válida',
                'id_carrera.min'=>'No seleccionó una carrera válida'
            ]);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()->all()]);
            }

            $grupo->grado = $request->grado;
            $grupo->grupo = $request->grupo;
            $grupo->generacion_inicio = $request->generacion_inicio;
            $grupo->generacion_fin = $request->generacion_fin;
            $grupo->turno = $request->turno;
            $grupo->id_institucion = $request->id_institucion;
            $grupo->id_maestro = $request->id_maestro;
            $grupo->id_carrera = $request->id_carrera;
            $grupo->grado = $request->grado;

//            dd($grupo->carrera->nombre);

            if($grupo->save()){
                return response()->json(['success'=>true,'carrera'=>$grupo->carrera->nombre]);
            }
        }else{
            return response()->json(['err'=>'No existe','success'=>false]);
        }
    }
}
