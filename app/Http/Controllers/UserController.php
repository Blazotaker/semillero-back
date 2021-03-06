<?php

namespace App\Http\Controllers;

use App\Director;
use App\User;
use Illuminate\Http\Request;
use DB;
use Validator;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $usuario = DB::table('usuarios')
                ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                ->join('roles', 'roles.id_rol', 'usuarios.id_rol')->get();
            if ($usuario->isEmpty()) {
                return response('', 204);
            } else {

                return $usuario;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function usuariosDirectores()
    {
        try {
            $directores = User::select(
                'usuarios.id_usuario',
                'usuarios.nombre_usuario',
                'usuarios.documento',
                'usuarios.estado',
                'usuarios.apellido_usuario',
                'usuarios.telefono',
                'usuarios.email',
                'usuarios.id_rol',
                'grupos.grupo',
                'tipo_usuarios.id_tipo_usuario',
                'tipo_usuarios.tipo_usuario',
                'grupos.id_grupo',
                'grupos.siglas'
            )
                ->leftJoin('directores', 'directores.id_usuario', 'usuarios.id_usuario')
                ->leftjoin('grupos', 'grupos.id_grupo', 'directores.id_grupo')
                ->leftjoin('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                ->where('id_rol', 2)->get();
            if ($directores->isEmpty()) {
                return response('', 204);
            } else {

                return $directores;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }



    public function usuariosCoordinadores($id)
    {
        try {
            $user = Director::select('directores.id_grupo')
                ->where('id_usuario', $id)
                ->first();
            if ($user == null) {
                $coordinadores = User::select(
                    'usuarios.id_usuario',
                    'usuarios.nombre_usuario',
                    'usuarios.documento',
                    'usuarios.estado',
                    'usuarios.apellido_usuario',
                    'usuarios.telefono',
                    'usuarios.email',
                    'usuarios.id_rol',
                    'tipo_usuarios.id_tipo_usuario',
                    'tipo_usuarios.tipo_usuario',
                    'semilleros.semillero',
                    'semilleros.id_semillero',
                    'grupos.id_grupo'
                )->leftJoin('coordinadores', 'coordinadores.id_usuario', 'usuarios.id_usuario')
                    ->leftjoin('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                    ->leftjoin('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                    ->leftjoin('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                    ->where([
                        ['id_rol', 3],

                    ])->get();

                    return $coordinadores;
            } else {
                $coordinadores = User::select(
                    'usuarios.id_usuario',
                    'usuarios.nombre_usuario',
                    'usuarios.documento',
                    'usuarios.estado',
                    'usuarios.apellido_usuario',
                    'usuarios.telefono',
                    'usuarios.email',
                    'usuarios.id_rol',
                    'tipo_usuarios.id_tipo_usuario',
                    'tipo_usuarios.tipo_usuario',
                    'semilleros.semillero',
                    'semilleros.id_semillero',
                    'grupos.id_grupo'
                )->leftJoin('coordinadores', 'coordinadores.id_usuario', 'usuarios.id_usuario')
                    ->leftjoin('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                    ->leftjoin('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                    ->leftjoin('grupos', 'grupos.id_grupo', 'semilleros.id_grupo')
                    ->where([
                        ['id_rol', 3],
                        ['grupos.id_grupo', $user->id_grupo]
                    ])->get();
                if ($coordinadores->isEmpty()) {
                    return response()->json('', 204);
                } else {

                    return $coordinadores;
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email|unique:usuarios|max:100',
                'nombre_usuario' => 'required|max:100',
                'apellido_usuario' => 'required|max:100',
                'documento' => 'required|max:20',
                'telefono' => 'required|max:20',
                'id_rol' => 'required|max:1',
                'id_tipo_usuario' => 'required|max:1',
                'estado' => 'required|max:1',
            ];
            $usuario = User::where('email', $request->email)
                ->orWhere('documento', $request->documento)->first();

            $validator = Validator::make($request->all(), $rules);

            if (!$usuario == null) {
                if ($usuario->email == $request->email) {
                    if($usuario->id_rol == 3 ){
                        return $usuario->id_usuario;
                    }
                    return response()->json('Ya hay un usuario registrado con este email', 221);
                } else {
                    if($usuario->id_rol == 3 ){
                        return $usuario->id_usuario;
                    }
                    return response()->json('Ya hay un usuario registrado con este documento', 221);
                }
            } elseif ($validator->fails()) {
                return response()->json($validator->errors(), 204);
            }
            $usuario = User::create($request->all());
            return $usuario->id_usuario;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function storeIntegrante(Request $request)
    {

        try {
            $rules = [
                'email' => 'required|email|unique:usuarios|max:100',
                'nombre_usuario' => 'required|max:100',
                'apellido_usuario' => 'required|max:100',
                'documento' => 'required|max:20',
                'telefono' => 'required|max:20',
                'id_rol' => 'required|max:1',
                'id_tipo_usuario' => 'required|max:1',
                'estado' => 'required|max:1',
            ];
            $usuario = User::where('email', $request->email)
                ->orWhere('documento', $request->documento)->first();

            $validator = Validator::make($request->all(), $rules);

            if (!$usuario == null) {
               return $usuario->id_usuario;
            } elseif ($validator->fails()) {
                return response()->json($validator->errors(), 204);
            }
            $usuario = User::create($request->all());
            return $usuario->id_usuario;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $usuario = User::where('id_usuario', $id)
                ->join('roles', 'roles.id_rol', 'usuarios.id_rol')
                ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')->get();
            if ($usuario->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $usuario;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function editCoordinador($id)
    {

        try {
            $coordinadores = User::select(
                'usuarios.id_usuario',
                'usuarios.nombre_usuario',
                'usuarios.documento',
                'usuarios.estado',
                'usuarios.apellido_usuario',
                'usuarios.telefono',
                'usuarios.email',
                'usuarios.id_rol',
                'tipo_usuarios.id_tipo_usuario',
                'tipo_usuarios.tipo_usuario',
                'semilleros.semillero',
                'semilleros.id_semillero',
                'semilleros.id_grupo'
            )->leftJoin('coordinadores', 'coordinadores.id_usuario', 'usuarios.id_usuario')
                ->leftjoin('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                ->leftjoin('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                ->where([
                    ['id_rol', 3],
                    ['usuarios.id_usuario', $id]
                ])->get();
            if ($coordinadores->isEmpty()) {
                return response()->json('', 204);
            } else {

                return $coordinadores;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $usuario = User::find($id);
            if ($usuario == null) {
                return response()->json('', 204);
            } else {
                return $usuario;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $usuario = User::where('id_usuario', $id)->get();
            if ($usuario->isEmpty()) {
                return response()->json('', 204);
            } else {
                User::where('id_usuario', $id)->update($request->all());
                return response()->json('Registro actualizado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function cambiarEstado($id, Request $request)
    {
        try {
            $usuario = User::where('id_usuario', $id)->get();
            if ($usuario->isEmpty()) {
                return response('', 204);
            } else {
                if ($request->estado == 1) {
                    $request->estado = 0;
                } else {
                    $request->estado = 1;
                }
                User::where('id_usuario', $id)->update(array('estado' => $request->estado));
                return response()->json('Registro actualizado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $usuario = User::where('id_usuario', $id)->get();
            if ($usuario->isEmpty()) {
                return response()->json('', 204);
            } else {
                User::where('id_usuario', $id)->delete();
                return response()->json('Registro eliminado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
        /*  try {
            $usuario = User::where('id_usuario', $id)->get();
            if ($usuario->isEmpty()) {
                return response('', 204);
            } else {
                if ($usuario->estado == 1) {
                    $usuario->estado = 0;
                } else {
                    $usuario->estado = 1;
                }
                User::where('id_usuario', $id)->update(array('estado' => $usuario->estado));
                return response()->json('Registro actualizado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        } */
    }
}
