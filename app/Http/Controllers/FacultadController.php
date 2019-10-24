<?php

namespace App\Http\Controllers;

use App\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Facultad::all();
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
        $facultad = Facultad::where('facultad',$request->facultad)->get();
        if(!$facultad->isEmpty()){
            return response('La facultad ya existe',221);
        }else{
            Facultad::create($request->all());
            return "Facultad creada";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facultad = Facultad::where('id_facultad',$id)->get();
        return $facultad;
        if($facultad->isEmpty()){
            return response('La facultad no existe',404);
        }else{
            return $facultad;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facultad = Facultad::find($id);
        if($facultad == null){
            return response('La facultad no existe',404);
        }else{
            return $facultad;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $facultad = Facultad::where('id_facultad',$id)->get();
        if($facultad->isEmpty()){
            return response('La facultad no existe',404);

        }else{
            Facultad::where('id_facultad',$id)->update($request->all());
            return "Revisar";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facultad = Facultad::where('id_facultad',$id)->get();
        if($facultad->isEmpty()){
            return response('La facultad no existe',404);

        }else{
            Facultad::where('id_facultad',$id)->delete();
            return "Revisar";
        }
    }
}
