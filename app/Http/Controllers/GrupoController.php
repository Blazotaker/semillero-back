<?php

namespace App\Http\Controllers;

use App\Grupo;
use Illuminate\Http\Request;
use DB;

class grupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo = DB::table('grupos')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->get();
        if($grupo->isEmpty()){
            return response('No hay nada para mostrar',404);

        }else{

            return ($grupo);
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
        $grupo = Grupo::where('grupo',$request->grupo)->get();
        if(!$grupo->isEmpty()){
            return response('El grupo ya existe',221);

        }else{
            Grupo::create($request->all());
             return response()->json("El usuario ha sido creado");;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::where('id_grupo',$id)->join('facultades','facultades.id_facultad','grupos.id_facultad')->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);
        }else{
           return $grupo;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::where('id_grupo',$id)->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);

        }else{
           return $grupo;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::where('id_grupo',$id)->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);

        }else{
            Grupo::where('id_grupo',$id)->update($request->all());
            return "Revisar";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::where('id_grupo',$id)->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);

        }else{
           Grupo::where('id_grupo',$id)->delete();
           return "Registro Eliminado";
        }
    }
}