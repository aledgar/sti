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
Route::get('/carreras','Super\CarrerasController@index')->name('carreras');
Route::post('/carreras','Super\CarrerasController@crear');
Route::get('/carreras/obtener','Super\CarrerasController@getCarreras');
Route::put('/carreras/{id}','Super\CarrerasController@editar');
Route::post('/carreras/{id}','Super\CarrerasController@cambiarEstado');


Route::get('/grupos','Super\GrupoController@index')->name('grupos.index');


Route::get('/maestros','Super\MaestroController@indexVista')->name('maestro.index');
Route::get('/maestros/api','Super\MaestroController@indexApi');
Route::get('/maestros/crear','Super\MaestroController@crear');
Route::post('/maestros/crear','Super\MaestroController@guardarMaestro');
Route::get('/maestros/editar/{id}','Super\MaestroController@editar');
Route::post('/maestros/editar','Super\MaestroController@editarMaestro');
Route::get('/maestros/select/{id}','Super\MaestroController@fillSelectInstituciones');
Route::post('/maestros-institucion/guardar','Super\MaestroController@agregarMaestroInsitucion');
Route::post('/maestros-institucion/desactivar','Super\MaestroController@desactivarMaestroInstitucion');

Route::get('/instituciones/asociadas','Maestro\InstitucionesController@index')->name('inst-asociadas');
Route::get('/instituciones/asociadas/tb','Maestro\InstitucionesController@indexTable');
Route::post('/instituciones/asociar-grupo','Maestro\InstitucionesController@crearGrupo');
Route::get('/instituciones/grupos','Maestro\GruposController@index')->name('maestros.grupos');
Route::put('/instituciones/grupos','Maestro\GruposController@editarCarrera');
Route::get('/instituciones/carreras','Maestro\GruposController@getCarreras');

//RUTAS DE MAESTROS
Route::get('/maestro/grupos/{id_institucion}/{id_maestro}','Maestro\GruposController@gruposPorInstitucion');
Route::get('/maestro/crear-alumno/{id}','Maestro\AlumnoController@crear')->name('maestro.crear-alumno');
Route::post('/maestro/crear-alumno','Maestro\AlumnoController@store')->name('maestro.store-alumno');
Route::get('/maestro/editar-alumno/{id}','Maestro\AlumnoController@show')->name('maestro.show-alumno');
Route::post('/maestro/editar-alumno','Maestro\AlumnoController@update')->name('maestro.update-alumno');
Route::get('/maestro/alumnos/{id}','Maestro\AlumnoController@index')->name('maestro.alumnos');
Route::post('/maestro/alumnos/status','Maestro\AlumnoController@status')->name('maestro.alumnos-status');
Route::get('/reporte-felder/{id}','Maestro\AlumnoController@reporteFelder')->name('maestro-felder');
Route::get('/reporte-conocimientos/{id}','Maestro\AlumnoController@reporteConocimientos')->name('maestro-conocimientos');



//RUTAS ALUMNOS
Route::get('/alumno/test-felder','Alumno\AlumnoController@felder')->name('alumno.felder');
Route::get('/alumno/test-conocimiento','Alumno\AlumnoController@conocimiento')->name('alumno.conocimiento');
Route::post('/alumno/guardar/test-felder','Alumno\AlumnoController@guardarResultadosFelder');
Route::post('/alumno/guardar/test-conocimiento','Alumno\AlumnoController@guardarResultadosConocimiento');
Route::get('/alumno/{id}/perfil','Alumno\AlumnoController@editar')->name('alumno-perfil');
Route::post('/alumno/editar/perfil','Alumno\AlumnoController@update')->name('alumno-perfil.editar');

Route::get('/home', 'HomeController@index')->name('home');
