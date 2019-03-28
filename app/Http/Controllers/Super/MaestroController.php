<?php

namespace App\Http\Controllers\Super;

use App\Maestro;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MaestroController extends Controller
{
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
}
