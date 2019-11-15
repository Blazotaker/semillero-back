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
        try {
            $tipo_productos = Tipo_producto::all();
            if ($tipo_productos->isEmpty()) {
                return response()->json('', 404);
            }
            return $tipo_productos;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        try {
            $tipo_producto = Tipo_producto::where('tipo_producto', $request->tipo_producto)->get();
            if (!$tipo_producto->isEmpty()) {
                return response()->json('', 400);
            } else {
                Tipo_producto::create($request->all());
                return response()->json('Tipo de producto creado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        try {
            $tipo_producto = Tipo_producto::where('id_tipo_producto', $id)->get();
            if ($tipo_producto->isEmpty()) {
                return response()->json('', 404);
            } else {
                return $tipo_producto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        try {
            $tipo_producto = Tipo_producto::find($id);
            if ($tipo_producto == null) {
                return response()->json('', 404);
            } else {
                return $tipo_producto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        try {
            $tipo_producto = Tipo_producto::where('id_tipo_producto', $id)->get();
            if ($tipo_producto->isEmpty()) {
                return response()->json('', 404);
            } else {
                Tipo_producto::where('id_tipo_producto', $id)->update($request->all());
                return response()->json("Tipo de producto actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        try {
            $tipo_producto = Tipo_producto::where('id_tipo_producto', $id)->get();
            if ($tipo_producto->isEmpty()) {
                return response()->json('', 404);
            } else {
                Tipo_producto::where('id_tipo_producto', $id)->delete();
                return response()->json("Tipo de producto eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
