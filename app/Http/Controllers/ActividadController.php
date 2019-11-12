<?php

namespace App\Http\Controllers;

use App\actividad;
use App\Mes_actividad;
use Illuminate\Http\Request;
use DB;

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
        ->leftJoin('periodos','periodos.id_periodo','actividades.id_periodo')
        ->leftJoin('semilleros','semilleros.id_semillero','actividades.id_semillero')
        ->get();
        if($actividad->isEmpty()){
            return response('',404);
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
        $actividad = Actividad::where([
            ['actividad',$request->actividad],
            ['id_periodo',$request->id_periodo]
            ])->get();
        if(!$actividad->isEmpty()){
            return response('La actividad ya existe',221);
        }else{
            $actividad = Actividad::create($request->all());
            return $actividad->id_actividad;
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
            return response('',404);

        }else{
            return $actividad;
        }
    }
    public function actividadesPeriodoSemillero($id_periodo)
    {
        $actividades = Actividad::select('actividades.id_actividad','actividad','meses.id_mes', 'actividades.responsable',
        'actividades.recursos', 'actividades.registro', 'actividades.estado')
        ->leftJoin('periodos','periodos.id_periodo','actividades.id_periodo')
        ->leftJoin('semilleros','semilleros.id_semillero','periodos.id_semillero')
        ->leftJoin('mes_actividades','mes_actividades.id_actividad','actividades.id_actividad')
        ->leftJoin('meses','meses.id_mes','mes_actividades.id_mes')
        ->where('actividades.id_periodo',$id_periodo)->get();




        if($actividades->isEmpty()){
            return response('',404);

        }else{
            return $actividades;
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
            return response('',404);
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
            return response('',404);

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
            return response('',404);

        }else{
            Actividad::where('id_actividad',$id)
            ->delete();
            return "Registro eliminado";
        }
    }
}
