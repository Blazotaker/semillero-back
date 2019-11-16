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
        try {
            $categoria = Categoria::all();
            if ($categoria->isEmpty()) {
                return response()->json('', 204);
            }
            return $categoria;
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
            $categoria = Categoria::where('categoria', $request->categoria)->get();
            if (!$categoria->isEmpty()) {
                return response()->json('', 221);
            }
            Categoria::create($request->all());
            return response()->json('Categoria creada');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $categoria = Categoria::where('id_categoria', $id)->get();
            if ($categoria->isEmpty()) {
                return response()->json('',204);
            }
            return $categoria;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $categoria = Categoria::find($id);
            if ($categoria == null) {
                return response()->json('', 204);
            }
            return $categoria;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
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
        try {
            $categoria = Categoria::where('id_categoria', $id)->get();
            if ($categoria->isEmpty()) {
                return response()->json('', 204);
            }
            Categoria::where('id_categoria', $id)->update($request->all());
            return response()->json('Categoria actualizada');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $categoria = Categoria::where('id_categoria', $id)->get();
            if ($categoria->isEmpty()) {
                return response()->json('', 204);
            }
            Categoria::where('id_categoria', $id)->delete();
            return response()->json('Categoria eliminada');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
