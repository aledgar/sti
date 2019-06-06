<?php

namespace App\Http\Controllers\Maestro;

use App\Alumno;
use App\ResultadosTest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maestro');
    }

    public function index($id)
    {
        $alumnos = DB::table('users')
            ->join('alumno', 'users.id', '=', 'alumno.id_user')
            ->where('alumno.id_grupo', $id)
            ->get();
        return view('maestro.alumno.index', ['id' => $id, 'alumnos' => $alumnos]);
    }

    public function crear($id)
    {
        return view('maestro.alumno.crear', ['id_grupo' => $id]);
    }

    public function store(Request $request)
    {
        $validations = [
            'nombre' => 'required|alpha|min:2|max:255',
            'apellido' => 'required|alpha|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|alpha_dash|max:16|min:5',
            'numero_lista' => 'required|integer'
        ];

        if (isset($request->foto)) {
            $validations['foto'] = 'mimes:jpeg,jpg,png';
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
            'foto.mimes' => 'Ingresa un formato (jpeg, jpg o png) para la foto.'
        ];

        Validator::make($request->all(), $validations, $messages)->validate();

        try {
            $user = new User();
            $user->name = $request->nombre;
            $user->lastname = $request->apellido;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->type = 3;
            if ($user->save()) {
                $alumno = new Alumno();
                $alumno->id_user = $user->id;
                $alumno->id_grupo = $request->id_grupo;
                $alumno->numero_lista = $request->numero_lista;
                if (isset($request->foto)) {
                    $image = $request->file('foto');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/alumnos/');
                    $image->move($destinationPath, $imageName);
                    $alumno->foto = $imageName;
                } else {
                    $alumno->foto = 'nofoto.png';
                }
                if ($alumno->save()) {
                    Session::flash('success', 'Se ha creado el alumno.');
                    return redirect()->route('maestros.grupos');
                } else {
                    Session::flash('error', 'Algo salió mal y no se pudo crear al alumno.');
                    return redirect()->route('maestro.crear-alumno', ['id' => $request->id_grupo]);
                }
            } else {
                Session::flash('error', 'Algo salió mal y no se pudo crear al alumno.');
                return redirect()->route('maestro.crear-alumno', ['id' => $request->id_grupo]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('maestro.alumno.editar', ['alumno' => $alumno]);
    }

    public function update(Request $request)
    {
        $validations = [
            'nombre' => 'required|alpha|min:2|max:255',
            'apellido' => 'required|alpha|min:2|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id_usuario,
            'password' => 'required|alpha_dash|max:16|min:5',
            'numero_lista' => 'required|integer'
        ];

        if (isset($request->foto)) {
            $validations['foto'] = 'mimes:jpeg,jpg,png';
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
            if($request->password!='123456789'){
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
                    unlink(public_path('images/alumnos/' . $alumno->foto));
                    $alumno->foto = $imageName;
                } else {
                    $alumno->foto = 'nofoto.png';
                }
                if ($alumno->save()) {
                    Session::flash('success', 'Se ha editado el alumno.');
                    return redirect()->route('maestros.grupos');
                } else {
                    Session::flash('error', 'Algo salió mal y no se pudo crear al alumno.');
                    return redirect()->route('maestro.crear-alumno', ['id' => $request->id_grupo]);
                }
            } else {
                Session::flash('error', 'Algo salió mal y no se pudo crear al alumno.');
                return redirect()->route('maestro.crear-alumno', ['id' => $request->id_grupo]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function status(Request $request)
    {
        $alumno = Alumno::findOrFail($request->id);
        if (isset($alumno)) {
            $alumno->deleted = !$alumno->deleted;
            if ($alumno->save()) {
                Session::flash('success', 'Se ha cambiado el estado del alumno');
                return redirect()->route('maestro.alumnos', ['id' => $request->id_grupo]);
            } else {
                Session::flash('error', 'Algo salió mal intente más tarde nuevamente');
                return redirect()->route('maestro.alumnos', ['id' => $request->id_grupo]);
            }
        } else {
            return redirect()->route('maestros.grupos');
        }
    }

    public function reporteFelder($id)
    {

        if (!isset($id)) {
            return redirect()->route('home');
        }

        $respuestas = ResultadosTest::where('id_alumno', $id)->where('test', 1)->get();

        if (sizeof($respuestas) == 0) {
            Session::flash('error', 'Este alumno aún no response el test de Felder');
            return redirect()->back();
        }

        $alumno = DB::table('users')
            ->join('alumno', 'users.id', '=', 'alumno.id_user')
            ->where('alumno.id', $id)
            ->select(['users.name', 'users.lastname'])
            ->first();

        $primerasRespuestas = [];
        $segundaRespuestas = [];
        $tercerasRespuestas = [];
        $cuartasRespuestas = [];

        $numPrimerasP = [];
        $numSegundasP = [];
        $numTercerasP = [];
        $numCuartasP = [];
        $cont = 0;
        //Para las primeras cuatro tablas
        for ($i = 0; $i < 41; $i = $i + 4) {
            array_push($primerasRespuestas, $respuestas[$i]->respuesta);
            $numPrimerasP[$cont] = $i + 1;
            $cont++;
        }

        $cont = 0;

        for ($i = 1; $i < 42; $i = $i + 4) {
            array_push($segundaRespuestas, $respuestas[$i]->respuesta);
            $numSegundasP[$cont] = $i + 1;
            $cont++;
        }

        $cont = 0;

        for ($i = 2; $i < 43; $i = $i + 4) {
            array_push($tercerasRespuestas, $respuestas[$i]->respuesta);
            $numTercerasP[$cont] = $i + 1;
            $cont++;
        }

        $cont = 0;

        for ($i = 3; $i < 44; $i = $i + 4) {
            array_push($cuartasRespuestas, $respuestas[$i]->respuesta);
            $numCuartasP[$cont] = $i + 1;
            $cont++;
        }

        //Para las segunda tabla
        //Array con sumas
        $array_sumas = [];
        for ($j = 0; $j < 4; $j++) {
            if ($j == 0)
                array_push($array_sumas, $this->sumaClasificacion($primerasRespuestas));
            else if ($j == 1)
                array_push($array_sumas, $this->sumaClasificacion($segundaRespuestas));
            else if ($j == 2)
                array_push($array_sumas, $this->sumaClasificacion($tercerasRespuestas));
            else
                array_push($array_sumas, $this->sumaClasificacion($cuartasRespuestas));
        }

        //SUMAS FINALES
        $sumasCadena = [];
        $letraCadena = [];
        foreach ($array_sumas as $key => $sumas) {
            if ($sumas[0] > $sumas[1]) {
                $sumasCadena[$key] = ($sumas[0] - $sumas[1]) . 'A';
                $letraCadena[$key] = 'A';
            } else {
                $sumasCadena[$key] = ($sumas[1] - $sumas[0]) . 'B';
                $letraCadena[$key] = 'B';
            }
        }
//        dd($sumasCadena);
        return view('maestro.alumno.felder', ['primeras' => $primerasRespuestas, 'segundas' => $segundaRespuestas,
            'terceras' => $tercerasRespuestas, 'cuartas' => $cuartasRespuestas, 'sumasTotales' => $array_sumas,
            'sumasCadena' => $sumasCadena, 'letraCadena' => $letraCadena, 'primPreg' => $numPrimerasP,
            'segPreg' => $numSegundasP, 'terPreg' => $numTercerasP, 'cuartPreg' => $numCuartasP, 'alumno' => $alumno]);
    }

    private function sumaClasificacion($arr)
    {
        $a = 0;
        $b = 0;
        $arrAux = [];
        foreach ($arr as $valor) {
            if ($valor === 1)
                $a++;
            else
                $b++;
        }
        $arrAux[0] = $a;
        $arrAux[1] = $b;
        return $arrAux;
    }

    public function reporteConocimientos($id)
    {
        if (!isset($id)) {
            return redirect()->route('home');
        }

        $respuestas = ResultadosTest::where('id_alumno', $id)->where('test', 2)->get();

        if (sizeof($respuestas) == 0) {
            Session::flash('error', 'Este alumno aún no response el test de Conocimiento.');
            return redirect()->back();
        }

        $alumno = DB::table('users')
            ->join('alumno', 'users.id', '=', 'alumno.id_user')
            ->where('alumno.id', $id)
            ->select(['users.name', 'users.lastname'])
            ->first();
        $respuestasCorreractas = ResultadosTest::where('id_alumno', $id)->where('test', 2)->where('correcta', 1)->count();
        $respuestasIncorrectas = ResultadosTest::where('id_alumno', $id)->where('test', 2)->where('correcta', 0)->count();

        $primerSeccion = ResultadosTest::where('id_alumno', $id)
            ->where('test', 2)
            ->where('correcta', 1)
            ->where('num_pregunta', '>=', 1)
            ->where('num_pregunta', '<=', 7)
            ->count();

        $segundaSeccion = ResultadosTest::where('id_alumno', $id)
            ->where('test', 2)
            ->where('correcta', 1)
            ->where('num_pregunta', '>=', 8)
            ->where('num_pregunta', '<=', 16)
            ->count();

        $terceraSeccion = ResultadosTest::where('id_alumno', $id)
            ->where('test', 2)
            ->where('correcta', 1)
            ->where('num_pregunta', '>=', 17)
            ->where('num_pregunta', '<=', 26)
            ->count();

        $arr[0] = $primerSeccion;
        $arr[1] = $segundaSeccion;
        $arr[2] = $terceraSeccion;
        $maximo = max($arr);

        return view('maestro.alumno.conocimiento',
            ['correctas' => $respuestasCorreractas, 'incorrectas' => $respuestasIncorrectas, 'pSeccion' => $primerSeccion,
                'sSeccion' => $segundaSeccion, 'tSeccion' => $terceraSeccion,
                'maximo' => array_search($maximo, $arr), 'alumno' => $alumno]);
    }

}
