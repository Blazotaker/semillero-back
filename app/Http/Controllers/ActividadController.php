<?php

namespace App\Http\Controllers;

use App\actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividad = DB::table('actividades')
        ->join('semilleros','semilleros.id_semillero','actividades.id_semillero')
        ->join('periodos','periodos.id_periodo','actividades.id_periodo')
        ->get();
        if($actividad->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{
            return $actividad;
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
        $actividad = Actividad::where('id_actividad',$request->id_actividad)
        ->get();
        if(!$actividad->isEmpty()){
            return response('La actividad ya existe',221);
        }else{
            Actividad::create($request->all());
            return "Actividad creada";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::where('id_actividad',$id)
        ->join('semilleros','semilleros.id_semillero','actividades.id_semillero')
        ->join('periodos','periodos.id_periodo','actividades.id_periodo')
        ->get();
        if($actividad->isEmpty()){
            return response('El actividad no existe',404);

        }else{
            return $actividad;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = Actividad::find($id);
        if($actividad == null){
            return response('La actividad no existe',404);
        }else{
            return $actividad;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $actividad = Actividad::where('id_actividad',$id)
        ->get();
        if($actividad->isEmpty()){
            return response('El actividad no existe',404);

        }else{
            Actividad::where('id_actividad',$id)
            ->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::where('id_actividad',$id)
        ->get();
        if($actividad->isEmpty()){
            return response('El actividad no existe',404);

        }else{
            Actividad::where('id_actividad',$id)
            ->delete();
            return "Registro eliminado";
        }
    }
}
