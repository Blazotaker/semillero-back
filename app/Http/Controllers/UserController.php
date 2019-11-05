<?php

namespace App\Http\Controllers;

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
        $usuario = DB::table('users')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')
        ->join('roles','roles.id_rol','users.id_rol')->get();
        if($usuario->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{

            return $usuario;
        }

    }

    public function usuariosDirectores()
    {
        $directores = User::select('users.id_usuario','users.nombre_usuario',
        'users.apellido_usuario','users.telefono','users.email',
        'users.id_rol','grupos.grupo','tipo_usuarios.tipo_usuario','grupos.id_grupo'
        )
        ->leftJoin('directores','directores.id_usuario','users.id_usuario')
        ->leftjoin('grupos','grupos.id_grupo','directores.id_grupo')
        ->leftjoin('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')
        ->where('id_rol',2)->get();
        if($directores->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{

            return $directores;
        }

    }

    public function usuariosCoordinadores()
    {
        $directores = User::select('users.id_usuario','users.nombre_usuario',
        'users.apellido_usuario','users.telefono','users.email',
        'users.id_rol','tipo_usuarios.id_tipo_usuario','semilleros.semillero'
        )->leftJoin('coordinadores','coordinadores.id_usuario','users.id_usuario')
        ->leftjoin('semilleros','semilleros.id_semillero','coordinadores.id_semillero')
        ->leftjoin('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')
        ->where('id_rol',3)->get();
        if($directores->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{

            return $directores;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users|max:100',
            'nombre_usuario' => 'required|max:100',
            'apellido_usuario' => 'required|max:100',
            'documento' => 'required|max:20',
            'telefono' => 'required|max:20',
            'id_rol' => 'required|max:1',
            'id_tipo_usuario' => 'required|max:1',
            'estado' => 'required|max:1',
        ];
        $usuario = User::where('email',$request->email)
        ->orWhere('documento', $request->documento)->first();

        $validator = Validator::make($request->all(),$rules);

        if(!$usuario==null){
            if($usuario->email == $request->email){
                return response()->json('Ya hay un usuario registrado con este email', 221);
            }else{
                return response()->json('Ya hay un usuario registrado con este documento', 221);
            }
            return response('El usuario ya existe',221);

        }elseif($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        User::create($request->all());
        return "Usuario creado";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::where('id_usuario',$id)
        ->join('roles','roles.id_rol','users.id_rol')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);
        }else{
           return $usuario;
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
        $usuario = User::find($id);
        if($usuario == null){
            return response('El usuario no existe',404);

        }else{
           return $usuario;
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
        $usuario = User::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
            User::where('id_usuario',$id)->update($request->all());
            return "Revisar";
        }
    }

    public function cambiarEstado($id, Request $request){
        $usuario = User::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
            if($request->estado == 1){
                $request->estado = 0;
            }else{
                $request->estado = 1;
            }
            User::where('id_usuario',$id)->update(array('estado'=> $request->estado));
            return "Registro cambiado";
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
        $usuario = User::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
           User::where('id_usuario',$id)->delete();
           return "Registro Eliminado";
        }

    }
}
