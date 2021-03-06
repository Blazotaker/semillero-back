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
    Route::get('grupo/informacion', 'GrupoController@indexPublico');
    Route::get('semillero/informacion', 'SemilleroController@indexPublico');
    Route::post('sociallogin/{provider}', 'Auth\LoginController@SocialSignup');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
    Route::get('status', 'Auth\LoginController@status');
    Route::get('exportar/inicial/{id_periodo}', 'ExportarController@exportFin13I');
    Route::get('exportar/final/{id_periodo}', 'ExportarController@exportFin13F');
    Route::get('exportar/pdf/{id_periodo}', 'ExportarController@exportPDF');
    Route::get('exportar/manual', 'ExportarController@exportManual');
    Route::get('coordinador/semillero/{id_semillero}', 'CoordinadorController@showBySemillero');

    Route::group(['middleware' => ['auth.jwt']], function () {
        /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/



    });


    Route::get('actividad/periodo/semillero/{id_periodo}', 'ActividadController@actividadesPeriodoSemillero');
    Route::get('actividad/semillero/actual/{id_semillero}', 'ActividadController@showActividadesActual');


    Route::get('proyecto/periodo/semillero/{id_periodo}', 'ProyectoController@proyectoPeriodoSemillero');

    Route::get('proyecto/semillero/actual/{id_semillero}', 'ProyectoController@showProyectosActual');

    Route::get('usuario/director', 'UserController@usuariosDirectores');
    Route::get('usuario/coordinador/{id}', 'UserController@usuariosCoordinadores');
    Route::get('usuario/coordinador/{id}/edit', 'UserController@editCoordinador');
    Route::put('usuario/{id}/estado', 'UserController@cambiarEstado');
    Route::post('usuario/integrante', 'UserController@storeIntegrante');

    Route::post('semillero/solicitud', 'SemilleroController@solicitud');
    Route::get('semillero/disponible', 'SemilleroController@indexAvailable');
    Route::get('semillero/grupo/{id_grupo}', 'SemilleroController@showPorGrupos');


    Route::get('grupo/disponible', 'GrupoController@indexAvailable');

    Route::get('periodo/actividad/{id_periodo}', 'PeriodoController@showPorPeriodoActividad');
    /**
     * Endpoints de productos
     *
     */
    Route::resource('producto', 'ProductoController');
    Route::post('producto/proyecto', 'ProductoController@storeProject');
    Route::post('producto/actividad', 'ProductoController@storeActivity');
    Route::get('producto/proyecto/{id_proyecto}', 'ProductoController@showProductProject');
    Route::get('producto/actividad/{id_proyecto}', 'ProductoController@showProductActivity');



    Route::get('integrante/semillero/periodo/{id_periodo}', 'IntegranteController@showSemilleroPeriodo');
    Route::get('integrante/semillero/noperiodo/{id_periodo}', 'IntegranteController@showSemilleroNoPeriodoActual');

    Route::get('integrante/semillero/actual/{id_semillero}', 'IntegranteController@showIntegrantesActual');

    Route::delete('integrante/periodo/{id_usuario}', 'IntegranteController@deleteIntegrantePeriodo');


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



    Route::resource('actividadmes', 'MesActividadController');




    /**
     *  Ubique abajo del comentario para realizar pruebas
     *
     */
});

/* Route::resource('grupo', 'GrupoController'); */



/* Route::get('status', 'GrupoController@status'); */
