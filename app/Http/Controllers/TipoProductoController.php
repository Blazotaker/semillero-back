<?php

namespace App\Http\Controllers;

use App\Tipo_producto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_productos = Tipo_producto::all();
        if($tipo_productos->isEmpty()){
            return response()->json('No hay nada para mostrar',404);
        }
        return $tipo_productos;

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
        $tipo_producto = Tipo_producto::where('tipo_producto',$request->tipo_producto)->get();
        if(!$tipo_producto->isEmpty()){
            return response('El tipo de producto ya existe',221);

        }else{
            Tipo_producto::create($request->all());
            return "Tipo de producto creado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_producto = Tipo_producto::where('id_tipo_producto',$id)->get();
        if($tipo_producto->isEmpty()){
            return response('El tipo de producto no existe',404);
        }else{
            return $tipo_producto;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_producto = Tipo_producto::find($id);
        if($tipo_producto == null){
            return response('El tipo de producto no existe',404);
        }else{
            return $tipo_producto;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_producto = Tipo_producto::where('id_tipo_producto',$id)->get();
        if($tipo_producto->isEmpty()){
            return response('El tipo de producto no existe',404);

        }else{
            Tipo_producto::where('id_tipo_producto',$id)->update($request->all());
            return "Tipo de producto eliminado";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_producto = Tipo_producto::where('id_tipo_producto',$id)->get();
        if($tipo_producto->isEmpty()){
            return response('El tipo de producto no existe',404);

        }else{
            Tipo_producto::where('id_tipo_producto',$id)->delete();
            return "Tipo de producto eliminado";
        }
    }
}
