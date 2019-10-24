<?php

namespace App\Http\Controllers;

use App\Integrante;
use Illuminate\Http\Request;
use DB;

class IntegranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $integrante = DB::table('integrantes')
        ->join('usuarios','usuarios.id_usuario','integrantes.id_usuario')
        ->join('semilleros','semilleros.id_semillero','integrantes.id_semillero')
        ->join('periodos','periodos.id_periodo','integrantes.id_periodo')
        ->get();
        if($integrante->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{
            return $integrante;
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
        //Se debe revisar
        $integrante = Integrante::where('id_integrante',$request->id_integrante)->get();
        if(!$integrante->isEmpty()){
            return response('El integrante ya existe',221);

        }else{
            Integrante::create($request->all());
            return "Integrante creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $integrante = Integrante::where('id_integrante',$id)
        ->join('usuarios','usuarios.id_usuario','integrantes.id_usuario')
        ->join('semilleros','semilleros.id_semillero','integrantes.id_semillero')
        ->join('periodos','periodos.id_periodo','integrantes.id_periodo')
        ->get();
        if($integrante->isEmpty()){
            return response('El integrante no existe',404);

        }else{
            return $integrante;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $integrante = Integrante::find($id);
        if($integrante == null){
            return response('El integrante no existe',404);

        }else{
            return "Integrante creado";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $integrante = Integrante::where('id_integrante',$id)
        ->get();
        if($integrante->isEmpty()){
            return response('El integrante no existe',404);

        }else{
            Integrante::where('id_integrante',$id)->update($request->all());
            return "Registro actualizado" ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $integrante = Integrante::where('id_integrante',$id)
        ->get();
        if($integrante->isEmpty()){
            return response('El integrante no existe',404);

        }else{
            Integrante::where('id_integrante',$id)->delete();
            return "Registro eliminado" ;
        }
    }
}
