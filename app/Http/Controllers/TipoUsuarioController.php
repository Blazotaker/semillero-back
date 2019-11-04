<?php

namespace App\Http\Controllers;

use App\Tipo_usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_usuarios =  Tipo_usuario::all();
        if($tipo_usuarios->isEmpty()){
            return response()->json("No hay nada para mostrar", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_usuario = Tipo_usuario::where('tipo_usuario',$request->tipo_usuario)->get();
        if(!$tipo_usuario->isEmpty()){
            return response('El tipo de usuario ya existe',221);

        }else{
            Tipo_usuario::create($request->all());
            return "Tipo de usuario creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_usuario = Tipo_usuario::where('id_tipo_usuario',$id)->get();
        if($tipo_usuario->isEmpty()){
            return response('El tipo de usuario no existe',404);
        }else{
            return $tipo_usuario;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_usuario = Tipo_usuario::find($id);
        if($tipo_usuario == null){
            return response('El tipo de usuario no existe',404);
        }else{
            return $tipo_usuario;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_usuario = Tipo_usuario::where('id_tipo_usuario',$id)->get();
        if($tipo_usuario->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Tipo_usuario::where('id_tipo_usuario',$id)->update($request->all());
            return "Tipo de usuario actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_usuario = Tipo_usuario::where('id_tipo_usuario',$id)->get();
        if($tipo_usuario->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Tipo_usuario::where('id_tipo_usuario',$id)->delete();
            return "Tipo de usuario eliminado";
        }
    }
}
