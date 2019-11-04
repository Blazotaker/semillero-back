<?php

namespace App\Http\Controllers;

use App\Mes;
use Illuminate\Http\Request;

class MesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meses = Mes::all();
        if($meses->isEmpty()){
            return response()->json('No hay nada para mostrar', 404);
        }

        return $meses;
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function show(Mes $mes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function edit(Mes $mes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mes $mes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mes $mes)
    {
        //
    }
}
