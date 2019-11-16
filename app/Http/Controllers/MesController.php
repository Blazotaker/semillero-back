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
        try {
            $meses = Mes::all();
            if ($meses->isEmpty()) {
                return response()->json('', 204);
            }

            return $meses;
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
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $meses = Mes::where([
                ['mes', $request->mes],
            ])->get();
            if (!$meses->isEmpty()) {
                return response()->json('', 221);
            } else {
                //$mes =
                 Mes::create($request->all());
                 return response()->json('Mes creado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $mes = Mes::find($id);
            if ($mes == null) {
                return response()->json('', 204);
            } else {
                return $mes;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $mes = Mes::find($id);
            if ($mes == null) {
                return response()->json('', 204);
            } else {
                return $mes;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $mes = Mes::where('id_mes', $id)->get();
            if ($mes->isEmpty()) {
                return response()->json('', 204);
            } else {
                Mes::where('id_mes', $id)->update($request->all());
                return response()->json("Mes actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mes  $mes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Mes = Mes::where('id_Mes', $id)->get();
            if ($Mes->isEmpty()) {
                return response()->json('', 204);
            } else {
                Mes::where('id_Mes', $id)->delete();
                return response()->json("Mes eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
