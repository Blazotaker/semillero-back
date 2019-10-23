<?php

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

Route::group(['middleware' => ['cors']], function () {
    Route::resource('usuario', 'UsuarioController');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('usuario', 'UsuarioController');

//


//
Route::resource('grupo', 'GrupoController');
//
Route::get('status', 'GrupoController@status');

Route::resource('facultad', 'FacultadController');
Route::resource('tipousuario', 'TipoUsuarioController');
Route::resource('rol', 'RolController');
Route::resource('periodo', 'PeriodoController');
Route::resource('semillero', 'SemilleroController');
Route::resource('integrante', 'IntegranteController');
Route::resource('coordinador', 'CoordinadorController');
