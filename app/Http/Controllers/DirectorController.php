<?php

namespace App\Http\Controllers;

use App\Director;
use Illuminate\Http\Request;
use DB;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = DB::table('directores')
        ->join('usuarios','usuarios.id_usuario','directores.id_usuario')
        ->join('grupos','grupos.id_grupo','directores.id_grupo')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','usuarios.id_tipo_usuario')
        ->join('roles','roles.id_rol','usuarios.id_rol')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->get();
        if($directores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }
        return $directores;
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
        Director::create($request->all());

        return 'Creado';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $director = Director::where('id_director',$id)
        ->join('usuarios','usuarios.id_usuario','directores.id_usuario')
        ->join('grupos','grupos.id_grupo','directores.id_grupo')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','usuarios.id_tipo_usuario')
        /* ->join('roles','roles.id_rol','usuarios.id_rol')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad') */
        ->get();
        if($director->isEmpty()){
            return response()->json('El director no existe',404);
        }
        return $director;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $director = Director::find($id);
        if($director== null){
            return response()->json('El director no existe',404);
        }
        return $director;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::where('id_director',$id)->get();
        if($grupo->isEmpty()){
            return response('El director no existe',404);

        }else{
            Grupo::where('id_director',$id)->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::where('id_director',$id)->get();
        if($grupo->isEmpty()){
            return response('El director no existe',404);

        }else{
           Grupo::where('id_director',$id)->delete();
           return "Registro Eliminado";
        }
    }
}
