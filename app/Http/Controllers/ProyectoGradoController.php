<?php

namespace App\Http\Controllers;

use App\Proyecto_grado;
use Illuminate\Http\Request;
use DB;

class ProyectoGradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyecto_grado = DB::table('proyecto_grados')
        ->join('semilleros','semilleros.id_semillero','proyecto_grados.id_semillero')
        ->join('periodos','periodos.id_periodo','proyecto_grados.id_periodo')
        ->get();
        if($proyecto_grado->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{
            return $proyecto_grado;
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
        $proyecto_grado = Proyecto_grado::where([
            ['proyecto_grado',$request->proyecto_grado],
            ['id_periodo',$request->id_periodo]
            ])
        ->get();
        if(!$proyecto_grado->isEmpty()){
            return response('El proyecto de grado ya existe',221);
        }else{
            Proyecto_grado::create($request->all());
            return "proyecto de grado creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proyecto_grado  $proyecto_grado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto_grado::where('id_proyecto_grado',$id)
        ->join('semilleros','semilleros.id_semillero','proyecto_grados.id_semillero')
        ->join('periodos','periodos.id_periodo','proyecto_grados.id_periodo')
        ->get();
        if($proyecto->isEmpty()){
            return response('El proyecto de grado no existe',404);

        }else{
            return $proyecto;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proyecto_grado  $proyecto_grado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto_grado::find($id);
        if($proyecto == null){
            return response('El proyecto de grado no existe',404);
        }else{
            return $proyecto;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proyecto_grado  $proyecto_grado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proyecto_grado = Proyecto_grado::where('id_proyecto_grado',$id)
        ->get();
        if($proyecto_grado->isEmpty()){
            return response('El proyecto de grado no existe',404);

        }else{
            Proyecto_grado::where('id_proyecto_grado',$id)
            ->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proyecto_grado  $proyecto_grado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto_grado::where('id_proyecto_grado',$id)
        ->get();
        if($proyecto->isEmpty()){
            return response('El proyecto no existe',404);

        }else{
            Proyecto_grado::where('id_proyecto_grado',$id)
            ->delete();
            return "Registro eliminado";
        }
    }
}
