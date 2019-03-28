<?php

namespace App\Http\Controllers\Super;

use App\Maestro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            ->join('maestros', 'user.id', '=', 'maestros.id_user')
            ->join('maestro_institucion', 'maestros.id', '=', 'maestro_institucion.id_maestro')
            ->join('institucion', 'maestro_institucion.id_institucion', '=', 'institucion.id')
            ->select('')
            ->get();
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
            'email' => 'required|email',
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

        return response()->json(['success' => 'Todo bien']);
    }
}
