<?php

namespace App\Http\Controllers;

use App\proyecto;
use Illuminate\Http\Request;
use DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyecto = DB::table('proyectos')
        ->join('semilleros','semilleros.id_semillero','proyectos.id_semillero')
        ->get();
        if($proyecto->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{
            return $proyecto;
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
        $proyecto = Proyecto::where([
            ['proyecto',$request->proyecto],
            ['id_semillero', $request->id_semillero]
        ])
        ->get();
        if(!$proyecto->isEmpty()){
            return response('El proyecto ya existe',221);
        }else{
            Proyecto::create($request->all());
            return "Proyecto creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function proyectoPeriodoSemillero($id)
    {
        $proyecto = Proyecto::select('id_proyecto','semillero','proyecto','vinculo')->where('id_semillero',$id)
        ->leftJoin('periodos','periodos.id_periodo','proyectos.id_periodo')
        ->leftJoin('semilleros','semilleros.id_semillero','periodos.id_semillero')
        ->leftJoin('productos','productos.id_proyecto','proyectos.id_proyecto')
        ->leftJoin('soportes','soportes.id_soporte','proyectos.id_soporte')
        ->get();
        if($proyecto->isEmpty()){
            return response('No hay nada para mostrar',404);

        }else{
            return $proyecto;
        }
    }

    public function show($id)
    {
        $proyecto = Proyecto::where('id_proyecto',$id)
        ->join('semilleros','semilleros.id_semillero','proyectos.id_semillero')
        ->get();
        if($proyecto->isEmpty()){
            return response('El proyecto no existe',404);

        }else{
            return $proyecto;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        if($proyecto == null){
            return response('El proyecto no existe',404);
        }else{
            return $proyecto;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::where('id_proyecto',$id)
        ->get();
        if($proyecto->isEmpty()){
            return response('El proyecto no existe',404);

        }else{
            Proyecto::where('id_proyecto',$id)
            ->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::where('id_proyecto',$id)
        ->get();
        if($proyecto->isEmpty()){
            return response('El proyecto no existe',404);

        }else{
            proyecto::where('id_proyecto',$id)
            ->delete();
            return "Registro eliminado";
        }
    }
}
