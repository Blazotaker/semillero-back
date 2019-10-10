<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('usuarios')->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','usuarios.id_tipo_usuario')
        ->join('roles','roles.id_rol','usuarios.id_rol')->get();
        
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
        //return "gg"; 
        $usuario = Usuario::where('id_usuario',$request->id_usuario)->get();
        if(!$usuario->isEmpty()){
            return response('El usuario ya existe',221); 
            
        }else{
            Usuario::create($request->all());
            return "Usuario creado";
        }
      //  $usuario = usuario::find(id_usuario);
       /*  $usuario = new usuario;
        $usuario->id_usuario = $request->id_usuario;
        $usuario->documento = $request->documento;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telefono = $request->telefono;
        $usuario->id_tipo_usuario = $request->id_tipo_usuario;

 */
        
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
