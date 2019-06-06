<?php

namespace App\Http\Controllers\Super;

use App\Carreras;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarrerasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    public function index(){
        return View('super_admin.carreras.index');
    }

    public function crear(Request $request){
        try{

            $carrera = new Carreras();
            $carrera->nombre = $request->nombre;
            $carrera->deleted = 0;

            $carrera->save();
            return response()->json(['success'=>true,'carrera'=>$carrera]);
        }catch (\Exception $e){
            return response()->json(['success'=>false,'errror'=>$e]);
        }
    }

    public function getCarreras(){
        $carreras = Carreras::get();
        return response()->json(['carreras'=>$carreras]);
    }

    public function editar($id,Request $request){
        try{
            $carrera = Carreras::find($id);
            $carrera->nombre = $request->nombre;
            $carrera->save();
            return response()->json(['success'=>true,'carrera'=>$carrera]);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'error'=>$exception]);
        }
    }

    public function cambiarEstado($id,Request $request){
        try{
            $carrera = Carreras::find($id);
            $carrera->deleted = $request->get('deleted');
            $carrera->save();
            return response()->json(['success'=>true]);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'error'=>$exception]);
        }
    }
}
