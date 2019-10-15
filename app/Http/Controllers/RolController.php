<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rol::all();
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
        $Rol = Rol::where('id_rol',$request->id_rol)->get();
        if(!$Rol->isEmpty()){
            return response('El rol ya existe',221);

        }else{
            Rol::create($request->all());
            return "Rol creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Rol = Rol::where('id_rol',$id)->get();
        if($Rol->isEmpty()){
            return response('El tipo de usuario no existe',404);
        }else{
            return $Rol;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Rol = Rol::where('id_rol',$id)->get();
        if($Rol->isEmpty()){
            return response('El tipo de usuario no existe',404);
        }else{
            return $Rol;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Rol = Rol::where('id_rol',$id)->get();
        if($Rol->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Rol::where('id_rol',$id)->update($request->all());
            return "Revisar";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Rol = Rol::where('id_rol',$id)->get();
        if($Rol->isEmpty()){
            return response('El tipo de usuario no existe',404);

        }else{
            Rol::where('id_rol',$id)->delete();
            return "Revisar";
        }
    }
}
