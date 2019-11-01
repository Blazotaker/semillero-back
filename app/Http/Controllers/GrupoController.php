<?php

namespace App\Http\Controllers;

use App\Grupo;
use Illuminate\Http\Request;
use DB;
use Validator;

class grupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo = DB::table('grupos')
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->join('categorias','categorias.id_categoria','grupos.id_categoria')
        ->get();
        if($grupo->isEmpty()){
            return response('No hay nada para mostrar',404);

        }else{

            return ($grupo);
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
        $rules =[
            'grupo' => 'required|max:50',
            'id_categoria' => 'required',
            'cod_colciencias' => 'required',
            'id_facultad' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        $grupo = Grupo::where('grupo',$request->grupo)->get();
        if(!$grupo->isEmpty()){
            return response('El grupo ya existe',221);

        }elseif($validator->fails()){
            return response()->json($validator->errors(),400);
        }else{
            Grupo::create($request->all());
            return response()->json("El grupo ha sido creado");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::where('id_grupo',$id)
        ->join('facultades','facultades.id_facultad','grupos.id_facultad')
        ->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);
        }else{
           return $grupo;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::find($id);
        if($grupo == null){
            return response('El grupo no existe',404);

        }else{
           return $grupo;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::where('id_grupo',$id)->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);

        }else{
            Grupo::where('id_grupo',$id)->update($request->all());
            return "Registro actualizado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = Grupo::where('id_grupo',$id)->get();
        if($grupo->isEmpty()){
            return response('El grupo no existe',404);

        }else{
           Grupo::where('id_grupo',$id)->delete();
           return "Registro Eliminado";
        }
    }


    public function status(){
        return "Sisas";
    }
}
