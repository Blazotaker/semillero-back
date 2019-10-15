<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Periodo::all();
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
        $periodo = Periodo::where('periodo',$request->periodo)->get();
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
        $periodo = Periodo::where('id_periodo',$id)->get();
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
        $periodo = Periodo::where('id_periodo',$id)->get();
        if($periodo->isEmpty()){
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
            return "Revisar";
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
            return "Revisar";
        }
    }
}
