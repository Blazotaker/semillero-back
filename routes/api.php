<?php

use App\Http\Controllers\ExportarController;
use App\Http\Controllers\grupoController;
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

    Route::get('proyecto/periodo/semillero/{id_periodo}','ProyectoController@proyectoPeriodoSemillero');

    Route::get('usuario/director','UserController@usuariosDirectores');
    Route::get('usuario/coordinador','UserController@usuariosCoordinadores');

    Route::put('usuario/{id}/estado','UserController@cambiarEstado');

    Route::post('semillero/solicitud','SemilleroController@solicitud');
    Route::get('semillero/disponible','SemilleroController@indexAvailable');



    Route::get('grupo/disponible','GrupoController@indexAvailable');
    Route::get('grupo/informacion','GrupoController@indexPublico');

    /**
     * Endpoints de productos
     *
     */
    Route::resource('producto', 'ProductoController');
    Route::post('producto/proyecto','ProductoController@storeProject');
    Route::post('producto/actividad','ProductoController@storeActivity');
    Route::get('producto/proyecto/{id_proyecto}', 'ProductoController@showProductProject');
    /* Route::get('producto/actividad/{id_proyecto}/edit', 'ProductoController@editActivity');
    Route::get('producto/proyecto/{id_proyecto}/edit', 'ProductoController@editProject'); */


    Route::get('integrante/semillero/periodo/{id_periodo}','IntegranteController@showSemilleroPeriodo');
    Route::get('integrante/semillero/noperiodo/{id_periodo}','IntegranteController@showSemilleroNoPeriodoActual');


    Route::resource('usuario', 'UserController');
    Route::resource('grupo', 'GrupoController');
    Route::resource('facultad', 'FacultadController');
    Route::resource('tipousuario', 'TipoUsuarioController');
    Route::resource('tipoproducto', 'TipoProductoController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('rol', 'RolController');
    Route::resource('periodo', 'PeriodoController');

    Route::resource('semillero', 'SemilleroController');

    Route::resource('integrante', 'IntegranteController');
    Route::resource('director', 'DirectorController');
    Route::resource('coordinador', 'CoordinadorController');
    Route::resource('actividad', 'ActividadController');
    Route::resource('proyecto', 'ProyectoController');

    Route::resource('soporte', 'SoporteController');

    Route::resource('mes', 'MesController');

    Route::get('exportar/inicial/{id_periodo}', 'ExportarController@exportFin13I');
    Route::get('exportar/final/{id_periodo}', 'ExportarController@exportFin13F');
    Route::get('exportar/pdf/{id_periodo}', 'ExportarController@exportPDF');

    Route::resource('actividadmes', 'MesActividadController');


    /* Route::resource('usuario', 'UserController'); */

    /*  Route::resource('grupo', 'GrupoController'); */
    // Route::get('status', 'GrupoController@status');


});

/* Route::resource('grupo', 'GrupoController'); */



/* Route::get('status', 'GrupoController@status'); */
