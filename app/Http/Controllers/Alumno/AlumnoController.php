<?php

namespace App\Http\Controllers\Alumno;

use App\Alumno;
use App\ResultadosTest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('alumno');
    }

    public function felder()
    {
        $alumno = Alumno::where('id_user', '=', auth()->id())->select(['id'])->first();
        return view('alumnos.test-felder', ['id_alumno' => $alumno->id]);
    }

    public function conocimiento()
    {
        $alumno = Alumno::where('id_user', '=', auth()->id())->select(['id'])->first();
        return view('alumnos.test-conocimiento', ['id_alumno' => $alumno->id]);
    }

    public function guardarResultadosFelder(Request $request)
    {
//        dd($request->respuestas);
        $testResuelto = ResultadosTest::where('id_alumno', '=', $request->id_alumno)->where('test', '=', 1)
            ->get();

        if (sizeof($testResuelto) > 0) {
            ResultadosTest::where('id_alumno', '=', $request->id_alumno)->where('test', '=', 1)
                ->delete();
        }

        $respuestas = $request->respuestas;
        foreach ($respuestas as $key => $respuesta) {
            $nuevaRespuesta = new ResultadosTest();
            $nuevaRespuesta->id_alumno = $request->id_alumno;
            $nuevaRespuesta->correcta = true;
            $nuevaRespuesta->num_pregunta = $key + 1;
            $nuevaRespuesta->respuesta = $respuesta;
            $nuevaRespuesta->test = 1;
            $nuevaRespuesta->save();
        }
        return response()->json(['success' => true]);
    }

    public function guardarResultadosConocimiento(Request $request)
    {
        $correctas = [1, 3, 4, 2, 3, 2, 1, 2, 3, 4, 2, 2, 4, 3, 2, 2, 2, 3, 2, 2, 3, 1, 1, 1, 3, 1];

        $testResuelto = ResultadosTest::where('id_alumno', '=', $request->id_alumno)->where('test', '=', 2)
            ->get();

        if (sizeof($testResuelto) > 0) {
            ResultadosTest::where('id_alumno', '=', $request->id_alumno)->where('test', '=', 2)
                ->delete();
        }

        $respuestas = $request->respuestas;
//        dd($respuestas);
        foreach ($respuestas as $key => $respuesta) {
            $nuevaRespuesta = new ResultadosTest();
            $nuevaRespuesta->id_alumno = $request->id_alumno;
            if ($respuesta == $correctas[$key]) {
                $nuevaRespuesta->correcta = true;
            } else {
                $nuevaRespuesta->correcta = false;
            }
            $nuevaRespuesta->num_pregunta = $key + 1;
            $nuevaRespuesta->respuesta = $respuesta;
            $nuevaRespuesta->test = 2;
            $nuevaRespuesta->save();
        }
        return response()->json(['success' => true]);
    }

    public function editar($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.perfil', ['alumno' => $alumno]);
    }

    public function update(Request $request)
    {

//        dd($request);
        $validations = [
            'nombre' => 'required|alpha|min:2|max:255',
            'apellido' => 'required|alpha|min:2|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id_usuario,
            'password' => 'required|alpha_dash|max:16|min:5',
            'numero_lista' => 'required|integer'
        ];

        if (isset($request->foto)) {
            $validations['foto'] = ' mimes:jpeg,jpg,png';
        }

        $messages = [
            'nombre.required' => 'Ingresa el nombre(s) del alumno.',
            'nombre.alpha' => 'Ingrese un nombre(s) válido.',
            'nombre.min' => 'Ingrese mínimo 2 caracteres como nombre(s) del alumno.',
            'nombre.max' => 'Ingrese máximo 255 caracteres para el nombre(s).',
            'apellido.required' => 'Ingresa el apellido(s) del alumno.',
            'apellido.alpha' => 'Ingrese un apellido(s) válido.',
            'apellido.min' => 'Ingrese mínimo 2 caracteres como apellido(s) del alumno.',
            'apellido.max' => 'Ingrese máximo 255 caracteres para el apellido(s).',
            'email.required' => 'Ingresa un email puede ser al(id del alumno)@edu.uaam.mx',
            'password.required' => 'Ingresa una contraseña.',
            'password.alpha_dash' => 'Ingresa una contraseña válida.',
            'password.min' => 'Ingresa mínimo 5 caracteres para la contraseña.',
            'password.max' => 'Ingresa máximo 16 caracteres para la contraseña.',
            'numero_lista.required' => 'Ingresa el número de lista del alumno.',
            'numero_lista.integer' => 'Ingresa número de lista válido.',
            'foto.mimes' => 'Ingresa un formato (jpeg, jpg o png) para la foto.',
            'email.unique' => 'El email ya está en uso por otra cuenta'
        ];

        Validator::make($request->all(), $validations, $messages)->validate();

        try {
            $user = User::find($request->id_usuario);
            $user->name = $request->nombre;
            $user->lastname = $request->apellido;
            if ($request->password != '123456789') {
                $user->password = bcrypt($request->password);
            }

            $user->email = $request->email;
            $user->type = 3;
            if ($user->save()) {
                $alumno = Alumno::find($request->id_alumno);
                $alumno->id_user = $user->id;
//                $alumno->id_grupo = $request->id_grupo;
                $alumno->numero_lista = $request->numero_lista;
                if (isset($request->foto)) {
                    $image = $request->file('foto');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/alumnos/');
                    $image->move($destinationPath, $imageName);
                    if ($alumno->foto != 'nofoto.png') {
                        unlink(public_path('images/alumnos/' . $alumno->foto));
                    }
                    $alumno->foto = $imageName;
                } else {
                    $alumno->foto = 'nofoto.png';
                }
                if ($alumno->save()) {
                    Session::flash('success', 'Se ha editado tu perfil.');
                    return redirect()->route('alumno-perfil', ['id' => $alumno->id]);
                } else {
                    Session::flash('error', 'Algo salió mal y no se pudo editar tu perfil.');
                    return redirect()->route('alumno-perfil', ['id' => $alumno->id]);
                }
            } else {
                Session::flash('error', 'Algo salió mal y no se pudo editar tu perfil.');
                return redirect()->route('alumno-perfil', ['id' => auth()->user()->alumno->id]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
