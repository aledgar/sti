<?php

namespace App\Http\Controllers\Super;

use App\Maestro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
}
