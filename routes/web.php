<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(Auth::guest()){
        return view('auth.login');
    }else{
        return view('home');
    }
});

Auth::routes();

Route::get('/alumnos','Super\AlumnoController@index')->name('alumnos');

Route::get('/instituciones','Super\InstitucionesController@index')->name('instituciones');
Route::get('/instituciones/crear','Super\InstitucionesController@create')->name('instituciones.create');
Route::post('/instituciones/crear','Super\InstitucionesController@store');
Route::get('/insituciones/obtener','Super\InstitucionesController@getInstituciones');
Route::get('/insituciones/buscar/{nombre}','Super\InstitucionesController@getInstitucionBusqueda');
Route::put('/insituciones/editar','Super\InstitucionesController@update');
Route::put('/instituciones/status/{id}','Super\InstitucionesController@changeStatus');

Route::get('/grupos','Super\GrupoController@index')->name('grupos.index');

Route::get('/maestros','Super\MaestroController@indexVista')->name('maestro.index');
Route::get('/maestros/crear','Super\MaestroController@crear');

Route::get('/home', 'HomeController@index')->name('home');
