<?php

namespace App\Http\Controllers\Super;

use App\Institucion;
use App\Maestro;
use App\MaestrosInstituciones;
use App\User;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MaestroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    public function indexVista()
    {
        return view('super_admin.maestros.index');
    }

    public function indexApi()
    {
        $maestros = DB::table('users')
            ->join('maestros', 'users.id', '=', 'maestros.id_user')
            ->select(['users.*','maestros.*'])
            ->get();

        return response()->json($maestros);
    }

    public function crear()
    {
        return view('super_admin.maestros.crear');
    }

    public function guardarMaestro(Request $request)
    {
        $validations = [
            'nombre' => 'required|regex:/^[a-zA-Z]{2,50}.*[\s\.]*$/',
            'apellido' => 'required|regex:/^[a-zA-Z]{2,50}.*[\s\.]*$/',
            'email' => 'required|email|unique:users',
            'contra' => 'required|min:8',
            'telefono' => 'required|regex:/[0-9]{10}/'
        ];

        if (isset($request->image)) {
            $validations['image'] = 'file|max:1000|mimes:jpg,jpeg,png';
        }

        $validator = Validator::make($request->all(), $validations,
            [
                'nombre.required'=>'Ingrese un nombre(s).',
                'nombre.regex' => 'Ingrese un nombre(s) válido.',
                'apellido.regex' => 'Ingrese un apellido(s) válido.',
                'apellido.required' => 'Ingrese un apellido(s).',
                'email.required' => 'Ingrese un email.',
                'email.email' => 'Ingrese un email válido.',
                'email.unique' => 'El email ya esta en uso por otra cuenta.',
                'contra.required' => 'Ingrese una contraseña.',
                'contra.min' => 'Ingrese una contraseña de mínimo 8 caracteres.',
                'telefono.regex' => 'Ingrese un teléfono válido.',
                'telefono.required' => 'Ingrese un teléfono.',
                'image.file' => 'Ingrese un archivo válido.',
                'image.max' => 'Ingrese una imagen de máximo 1MB.',
                'image.mimes' => 'Ingrese un documento válido (jpg, jpeg o png).'
            ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        //Tipo 2 para maestros;
        $user = new User();
        $user->name = $request->nombre;
        $user->lastname = $request->apellido;
        $user->type = 2;
        $user->email = $request->email;
        $user->password = Hash::make($request->contra);

        if($user->save()){
            $maestro = new Maestro();
            $maestro->telefono = $request->telefono;
            $maestro->id_user = $user->id;
            if(isset($request->image)){
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('images/maestros/');
                $image->move($destinationPath, $imageName);
                $maestro->foto = $imageName;
            }
            if($maestro->save()){
                return response()->json(['exito'=>true]);
            }else{
                $user = User::find($user->id);
                $user->delete();
                return response()->json(['errors'=>['Algo sucedio mal, intente más tarde por favor.']]);
            }
        }else{
            return response()->json(['errors'=>['Algo sucedio mal, intente más tarde por favor.']]);
        }
    }

    public function editar($id){
//        $maestro = Maestro::find($id);
        $maestro = DB::table('maestros')
                ->join('users','maestros.id_user','=','users.id')
                ->select(['users.id as id_user','maestros.id as id_maestro','users.name','users.lastname','users.email','maestros.telefono','maestros.foto'])
                ->where('maestros.id','=',$id)
                ->get();
        if(strlen($maestro)>0){
            return view('super_admin.maestros.editar',['maestro'=>json_encode($maestro[0])]);
        }else{
            return view('super_admin.maestros.index');
        }
    }

    public function editarMaestro(Request $request){
//        return response()->json(['llega'=>$request->all()]);
        $validations = [
            'nombre' => 'required|regex:/^[a-zA-Z]{2,50}.*[\s\.]*$/',
            'apellido' => 'required|regex:/^[a-zA-Z]{2,50}.*[\s\.]*$/',
            'email' => 'required|email|unique:users,email,'.$request->id_user,
            'telefono' => 'required|regex:/[0-9]{10}/'
        ];

        if($request->contra!='contraseña_no_editar'){
            $validations['contra'] = 'required|min:8';
        }

        if (isset($request->image)) {
            $validations['image'] = 'file|max:1000|mimes:jpg,jpeg,png';
        }

        $validator = Validator::make($request->all(), $validations,
            [
                'nombre.required'=>'Ingrese un nombre(s).',
                'nombre.regex' => 'Ingrese un nombre(s) válido.',
                'apellido.regex' => 'Ingrese un apellido(s) válido.',
                'apellido.required' => 'Ingrese un apellido(s).',
                'email.required' => 'Ingrese un email.',
                'email.email' => 'Ingrese un email válido.',
                'email.unique' => 'El email ya esta en uso por otra cuenta.',
                'contra.required' => 'Ingrese una contraseña.',
                'contra.min' => 'Ingrese una contraseña de mínimo 8 caracteres.',
                'telefono.regex' => 'Ingrese un teléfono válido.',
                'telefono.required' => 'Ingrese un teléfono.',
                'image.file' => 'Ingrese un archivo válido.',
                'image.max' => 'Ingrese una imagen de máximo 1MB.',
                'image.mimes' => 'Ingrese un documento válido (jpg, jpeg o png).'
            ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        //Tipo 2 para maestros;
        $user = User::find($request->id_user);
        $user->name = $request->nombre;
        $user->lastname = $request->apellido;
        $user->type = 2;
        $user->email = $request->email;
        if($request->contra!='contraseña_no_editar'){
            $user->password = Hash::make($request->contra);
        }

        if($user->save()){
            $maestro = Maestro::find($request->id_maestro);
            $maestro->telefono = $request->telefono;
            if(isset($request->image)){

                if(strlen($maestro->foto)>0){
                    $path = public_path('images/maestros/'+$maestro->foto);
                    if(file_exists($path)){
                        @unlink($path);
                    }
                }

                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('images/maestros/');
                $image->move($destinationPath, $imageName);
                $maestro->foto = $imageName;
            }
            if($maestro->save()){
                return response()->json(['exito'=>true]);
            }else{
                $user = User::find($user->id);
                $user->delete();
                return response()->json(['errors'=>['Algo sucedio mal, intente más tarde por favor.']]);
            }
        }else{
            return response()->json(['errors'=>['Algo sucedio mal, intente más tarde por favor.']]);
        }
    }

    public function fillSelectInstituciones($id){
        $faltantes = DB::table('institucion')
                        ->whereNotIn('id',DB::table('maestros_instituciones')->where('id_maestro','=',$id)->pluck('id_institucion'))
                        ->select(['institucion.nombre','institucion.id'])
                        ->get();

        $agregadas = DB::table('institucion')
                        ->join('maestros_instituciones','institucion.id','=','maestros_instituciones.id_institucion')
                        ->select(['institucion.id','institucion.nombre','maestros_instituciones.id as id_mi','maestros_instituciones.deleted'])
                        ->where('maestros_instituciones.id_maestro','=',$id)
                        ->get();
        return response()->json(['faltantes'=>$faltantes,'agregadas'=>$agregadas]);
    }

    public function agregarMaestroInsitucion(Request $request){
//        return response()->json($request->all());
        $maestroI = new MaestrosInstituciones();
        $maestroI->id_maestro = $request->id_maestro;
        $maestroI->id_institucion = $request->id_institucion;
        $maestroI->deleted = 0;
        if($maestroI->save()){
            $institucion = Institucion::where('id','=',$maestroI->id_institucion)
                ->select(['nombre'])
                ->get();
            return response()->json(['exito'=>true,'maestroInst'=>$maestroI,'institucion'=>$institucion]);
        }else{
            return response()->json(['exito'=>false]);
        }
    }

    public function desactivarMaestroInstitucion(Request $request){
        $maestroInst = MaestrosInstituciones::find($request->id);
        if(strlen($maestroInst)>0){
            $maestroInst->deleted = !$request->status;
            if($maestroInst->save()){
                return response()->json(['exito'=>true,'status'=>$maestroInst->deleted]);
            }else{
                return response()->json(['exito'=>false]);
            }
        }else{
            return response()->json(['exito'=>false]);
        }
    }
}
