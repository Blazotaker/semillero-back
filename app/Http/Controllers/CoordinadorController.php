<?php

namespace App\Http\Controllers;

use App\Coordinador;
use Illuminate\Http\Request;
use DB;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coordinadores = DB::table('coordinadores')
        ->join('semilleros','semilleros.id_semillero','coordinadores.id_semillero')
        ->join('periodos','periodos.id_periodo','coordinadores.id_periodo')->get();
        if($coordinadores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }
        return $coordinadores;
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
        Coordinador::create($request->all());

        return 'Creado';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coordinador = Coordinador::where('id_coordinador',$id)
        ->join('semilleros','semilleros.id_semillero','coordinadores.id_semillero')
        ->join('periodos','periodos.id_periodo','coordinadores.id_periodo')->get();
        if($coordinador->isEmpty()){
            return response()->json('El coordinador no existe',404);
        }
        return $coordinador;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coordinadores = Coordinador::where('id_coordinador',$id)
        ->get();
        if($coordinadores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }else{
            return $coordinadores;
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coordinadores = Coordinador::where('id_coordinador',$id)
        ->get();
        if($coordinadores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }else{
            Coordinador::where('id_coordinador',$id)->update($request->all());
            return response()->json('Registro actualizado',200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coordinadores = Coordinador::where('id_coordinador',$id)
        ->get();
        if($coordinadores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }else{
            Coordinador::where('id_coordinador',$id)->delete();
            return response()->json('Registro eliminado',200);
        }
    }
}
