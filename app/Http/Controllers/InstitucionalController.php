<?php

namespace App\Http\Controllers;

use App\Institucional;
use Illuminate\Http\Request;
use DB;

class InstitucionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institucionales = DB::table('institucionales')
        ->join('semilleros','semilleros.id_semillero','institucionales.id_semillero')
        ->join('periodos','periodos.id_periodo','institucionales.id_periodo')
        ->get();
        if($institucionales->isEmpty()){
            return response('No hay nada para mostrar',404);
        }else{
            return $institucionales;
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
        $institucional = Institucional::where([
            ['nombre_institucional',$request->nombre_institucional],
            ['id_periodo',$request->id_periodo]
            ])
        ->get();
        if(!$institucional->isEmpty()){
            return response('El documento institucional ya existe',221);
        }else{
            Institucional::create($request->all());
            return "Documento institucional creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\institucional  $institucional
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institucional = Institucional::where('id_institucional',$id)
        ->join('semilleros','semilleros.id_semillero','institucionales.id_semillero')
        ->join('periodos','periodos.id_periodo','institucionales.id_periodo')
        ->get();
        if($institucional->isEmpty()){
            return response('El documento institucional no existe',404);

        }else{
            return $institucional;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\institucional  $institucional
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institucional = Institucional::find($id);
        if($institucional == null){
            return response('El documento institucional no existe',404);
        }else{
            return $institucional;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\institucional  $institucional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $institucional = Institucional::where('id_institucional',$id)
        ->get();
        if($institucional->isEmpty()){
            return response('El documento insitucional no existe',404);

        }else{
            Institucional::where('id_institucional',$id)
            ->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\institucional  $institucional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institucional = Institucional::where('id_institucional',$id)
        ->get();
        if($institucional->isEmpty()){
            return response('El documento insitucional no existe',404);

        }else{
            Institucional::where('id_institucional',$id)
            ->delete();
            return "Registro eliminado";
        }
    }
}
