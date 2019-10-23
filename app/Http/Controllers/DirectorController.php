<?php

namespace App\Http\Controllers;

use App\Director;
use Illuminate\Http\Request;
use DB;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = DB::table('directores')
        ->join('grupos','grupos.id_semillero','directores.id_semillero')
        ->join('periodos','periodos.id_periodo','directores.id_periodo')->get();
        if($directores->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }
        return $directores;
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
        Coordinador::create($request->all());

        return 'Creado';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $director = Coordinador::where('id_director',$id)
        ->join('semilleros','semilleros.id_semillero','coordinadores.id_semillero')
        ->join('periodos','periodos.id_periodo','coordinadores.id_periodo')->get();
        if($director->isEmpty()){
            return response()->json('El director no existe',404);
        }
        return $director;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $director = Coordinador::where('id_director',$id)
        ->join('semilleros','semilleros.id_semillero','coordinadores.id_semillero')
        ->join('periodos','periodos.id_periodo','coordinadores.id_periodo')->get();
        if($director->isEmpty()){
            return response()->json('El director no existe',404);
        }
        return $director;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, director $director)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(director $director)
    {
        //
    }
}
