<?php

namespace App\Http\Controllers\Maestro;

use App\Carreras;
use App\Grupo;
use App\Maestro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstitucionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maestro');
    }

    public function index(){
//        $institucionesMaestro = DB::table('maestros')
//            ->join('maestros_instituciones','maestros.id','=','maestros_instituciones.id_maestro')
//            ->join('institucion','maestros_instituciones.id_institucion','=','institucion.id')
//            ->where('maestros.id_user','=',auth()->user()->id)
//            ->select(['institucion.id','institucion.nombre'])
//            ->get();

        return view('maestro.instituciones.index');
    }

    public function indexTable(){
        $institucionesMaestro = DB::table('maestros')
            ->join('maestros_instituciones','maestros.id','=','maestros_instituciones.id_maestro')
            ->join('institucion','maestros_instituciones.id_institucion','=','institucion.id')
            ->where('maestros.id_user','=',auth()->user()->id)
            ->select(['institucion.id','institucion.nombre'])
            ->get();

        $carreras = Carreras::where('deleted','=',0)->get();

        $maestro = Maestro::where('id_user','=',auth()->user()->id)
            ->select(['id'])
            ->first();

        return response()->json([
            'institucionesMaestro'=>$institucionesMaestro,
            'maestroId' => $maestro->id,
            'carreras'=>$carreras
        ]);
    }

    public function crearGrupo(Request $request){
        $validations = [
            'grado'=>'required|numeric|min:1',
            'grupo'=>'required|alpha|min:1',
            'generacion_inicio'=>'required|numeric',
            'generacion_fin'=>'required|numeric',
            'turno'=>'required|alpha|min:1',
            'carrera'=>'required|numeric|min:1'
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
            'id_carrera.min'=>'No selecciono una carrera válida'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $grupo = new Grupo();
        $grupo->grado = $request->grado;
        $grupo->grupo = $request->grupo;
        $grupo->generacion_inicio = $request->generacion_inicio;
        $grupo->generacion_fin = $request->generacion_fin;
        $grupo->turno = $request->turno;
        $grupo->id_institucion = $request->id_institucion;
        $grupo->id_maestro = $request->id_maestro;
        $grupo->id_carrera = $request->id_carrera;

        if($grupo->save()){
            return response()->json(['success'=>true,'msg'=>'Se ha guardado al grupo']);
        }else{
            return response()->json(['errors'=>['Algo salio mal intentando intentalo más tarde']]);
        }

    }
}
