<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = DB::table('usuarios')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','usuarios.id_tipo_usuario')
        ->join('roles','roles.id_rol','usuarios.id_rol')->get();
        if($usuario->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{

            return $usuario;
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
            'email' => 'required|email|unique:usuarios|max:100',
            'nombre_usuario' => 'required|max:100',
            'apellido_usuario' => 'required|max:100',
            'documento' => 'required|max:20',
            'telefono' => 'required|max:20',
            'id_rol' => 'required|max:1',
            'id_tipo_usuario' => 'required|max:1',
            'estado' => 'required|max:1',
        ];
        $usuario = Usuario::where('email',$request->email)->get();
        $validator = Validator::make($request->all(),$rules);

        if(!$usuario->isEmpty()){
            return response('El usuario ya existe',221);

        }elseif($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        Usuario::create($request->all());
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
        $usuario = Usuario::where('id_usuario',$id)->join('roles','roles.id_rol','usuarios.id_rol')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','usuarios.id_tipo_usuario')->get();
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
        $usuario = Usuario::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
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
        $usuario = Usuario::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
            Usuario::where('id_usuario',$id)->update($request->all());
            return "Revisar";
        }
    }

    public function cambiarEstado($id, Request $request){
        $usuario = Usuario::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
            if($request->estado == 1){
                $request->estado = 0;
            }else{
                $request->estado = 1;
            }
            Usuario::where('id_usuario',$id)->update(array('estado'=> $request->estado));
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
        $usuario = Usuario::where('id_usuario',$id)->get();
        if($usuario->isEmpty()){
            return response('El usuario no existe',404);

        }else{
           Usuario::where('id_usuario',$id)->delete();
           return "Registro Eliminado";
        }

    }
}
