<?php

namespace App\Http\Controllers;

use App\Semillero;
use Illuminate\Http\Request;
use DB;

class SemilleroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semillero = DB::table('semilleros')
        ->join('grupos','grupos.id_grupo','semilleros.id_grupo')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->get();
        if($semillero->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{

            return $semillero;
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
        $semillero = Semillero::where('semillero',$request->semillero)->get();
        if(!$semillero->isEmpty()){
            return response('El semillero ya existe',221);

        }else{
            Semillero::create($request->all());
            return "Semillero creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semillero = Semillero::where('id_semillero',$id)
        ->join('grupos','grupos.id_grupo','semilleros.id_grupo')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->get();
        if($semillero->isEmpty()){
            return response('El semillero no existe',404);
        }else{
            return $semillero;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semillero = Semillero::where('id_semillero',$id)->get();
        if($semillero->isEmpty()){
            return response('El semillero no existe',404);

        }else{
           return $semillero;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $semillero = Semillero::where('id_semillero',$id)->get();
        if($semillero->isEmpty()){
            return response('El semillero no existe',404);

        }else{
            Semillero::where('id_semillero',$id)->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semillero = Semillero::where('id_semillero',$id)->get();
        if($semillero->isEmpty()){
            return response('El semillero no existe',404);

        }else{
           Semillero::where('id_semillero',$id)->delete();
           return "Registro Eliminado";
        }
    }
}
