<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;
use DB;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::select('periodos.id_periodo','periodo','fecha_inicio','fecha_fin','semillero','semilleros.id_semillero')
        ->join('semilleros','semilleros.id_semillero','periodos.id_semillero')
        ->get();
        if($periodos->isEmpty()){
            return response()->json('No hay nada para mostrar', 404);
        }
        return $periodos;
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
        $periodo = Periodo::where([
            ['periodo',$request->periodo],
            ['id_semillero',$request->id_semillero]
            ])->get();
        if(!$periodo->isEmpty()){
            return response('El periodo ya existe',221);

        }else{
            Periodo::create($request->all());
            return "Periodo creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periodo = Periodo::select('periodos.id_periodo','periodo','fecha_inicio','fecha_fin','semillero','semilleros.id_semillero')
        ->where('id_periodo',$id)
        ->join('semilleros','semilleros.id_semillero','periodos.id_semillero')
        ->get();
        if($periodo->isEmpty()){
            return response('El periodo no existe',404);
        }else{
            return $periodo;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periodo = Periodo::find($id);
        if($periodo == null){
            return response('El periodo no existe',404);
        }else{
            return $periodo;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periodo = Periodo::where('id_periodo',$id)->get();
        if($periodo->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Periodo::where('id_periodo',$id)->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = Periodo::where('id_periodo',$id)->get();
        if($periodo->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Periodo::where('id_periodo',$id)->delete();
            return "Registro actualizado";
        }
    }
}
