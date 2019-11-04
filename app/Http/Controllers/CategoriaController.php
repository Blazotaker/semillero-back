<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria =Categoria::all();
        if(categoria->isEmpty()){
            return response()->json('No hay nada para mostrar', 404);
        }
        return $categoria;
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
        $categoria = Categoria::where('categoria',$request->categoria)->get();
        if(!$categoria->isEmpty()){
            return response()->json('La categoría ya existe', 221);
        }
        Categoria::create($request->all());
        return response()->json('Categoría creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::where('id_categoria',$id)->get();
        if($categoria->isEmpty()){
            return response()->json('La categoría no existe', 221);
        }
        return $categoria;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        if($categoria == null){
            return response()->json('La categoría no existe', 221);
        }
        return $categoria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::where('id_categoria',$id)->get();
        if($categoria->isEmpty()){
            return response()->json('La categoría no existe', 221);
        }
        Categoria::where('id_categoria',$id)->update($request->all());
        return response()->json('Registro actualizado',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::where('id_categoria',$id)->get();
        if($categoria->isEmpty()){
            return response()->json('La categoría no existe', 221);
        }
        Categoria::where('id_categoria',$id)->delete();
        return response()->json('Registro eliminado',200);
    }
}
