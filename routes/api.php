<?php

use App\Http\Controllers\ExportarController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::group(['middleware' => ['cors']], function () {
    Route::resource('usuario', 'UsuarioController');
}); */


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::resource('usuario', 'UsuarioController'); */
Route::get('usuario/importar/', 'UserController@import');
//

Route::group(['middleware' => ['cors']], function () {
    /**
     * LOGIN
     */
    Route::post('sociallogin/{provider}', 'Auth\LoginController@SocialSignup');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
    Route::get('status', 'Auth\LoginController@status');

    Route::group(['middleware' => ['auth.jwt']], function () {
        /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/ });

    /**
     *  Ubique abajo del comentario para realizar pruebas
     *
     */
    Route::get('actividad/periodo/semillero/{id_periodo}','ActividadController@actividadesPeriodoSemillero');
    Route::get('usuario/director','UserController@usuariosDirectores');
    Route::get('usuario/coordinador','UserController@usuariosCoordinadores');

    Route::resource('usuario', 'UserController');
    Route::resource('grupo', 'GrupoController');
    Route::resource('facultad', 'FacultadController');
    Route::resource('tipousuario', 'TipoUsuarioController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('rol', 'RolController');
    Route::resource('periodo', 'PeriodoController');
    Route::resource('semillero', 'SemilleroController');
    Route::resource('integrante', 'IntegranteController');
    Route::resource('director', 'DirectorController');
    Route::resource('coordinador', 'CoordinadorController');
    Route::resource('actividad', 'ActividadController');
    Route::resource('proyecto', 'ProyectoController');
    Route::resource('proyectogrado', 'ProyectoGradoController');
    Route::resource('institucional', 'InstitucionalController');
    Route::resource('soporte', 'SoporteController');
    Route::get('exportar/inicial', 'ExportarController@export1');
    Route::get('exportar/final', 'ExportarController@export2');
    Route::resource('actividadmes', 'MesActividadController');


    /* Route::resource('usuario', 'UserController'); */

    /*  Route::resource('grupo', 'GrupoController'); */
    // Route::get('status', 'GrupoController@status');


});

/* Route::resource('grupo', 'GrupoController'); */



/* Route::get('status', 'GrupoController@status'); */
