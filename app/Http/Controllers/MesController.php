<?php

namespace App\Http\Contmeslers;

use App\Mes;
use Illuminate\Http\Request;

class MesContmesler extends Contmesler
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meses = Mes::all();
        if($meses->isEmpty()){
            return response()->json('No hay nada para mostrar', 404);
        }

        return $meses;
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
        $meses = Mes::where([
            ['mes',$request->mes],
            ])->get();
        if(!$meses->isEmpty()){
            return response('El mes ya existe',221);
        }else{
            $mes = Mes::create($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mes = Mes::find($id);
        if($mes == null){
            return response('El mes no existe',404);
        }else{
            return $mes;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mes = Mes::find($id);
        if($mes == null){
            return response('El mes no existe',404);
        }else{
            return $mes;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mes = Mes::where('id_mes',$id)->get();
        if($mes->isEmpty()){
            return response('El mes no existe',404);

        }else{
            Mes::where('id_mes',$id)->update($request->all());
            return response()->json("Mes actualizado");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Rol = Rol::where('id_rol',$id)->get();
        if($Rol->isEmpty()){
            return response('El rol no existe',404);

        }else{
            Rol::where('id_rol',$id)->delete();
            return response()->json("Mes eliminado");
        }
    }
}
