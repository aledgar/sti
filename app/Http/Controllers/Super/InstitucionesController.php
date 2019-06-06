<?php

namespace App\Http\Controllers\Super;

use App\Institucion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InstitucionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('super_admin.instituciones.index');
    }

    public function getInstituciones(){
        $instituciones = Institucion::get();
        return response()->json($instituciones);
    }

    public function getInstitucionBusqueda($nombre){
        $instituciones = Institucion::where('nombre','like','%'.$nombre.'%')->get();
        return $instituciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('super_admin.instituciones.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institucion = new Institucion();
        $institucion->nombre = $request->nombre;
        $institucion->deleted = 0;
        $institucion->save();
        return $institucion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $institucion = Institucion::findOrFail($request->id);
        $institucion->nombre = $request->nombre;
        $institucion->save();
        return $institucion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        $institucion = Institucion::findOrFail($id);
        $institucion->deleted = ($institucion->deleted == 0)? 1 : 0;
        $institucion->save();
        return $institucion;
    }
}
