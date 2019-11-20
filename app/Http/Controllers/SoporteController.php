<?php

namespace App\Http\Controllers;

use App\soporte;
use Illuminate\Http\Request;

class SoporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $soporte = Soporte::where('vinculo', $request->soporte)
                ->orWhere([
                    ['vinculo', $request->soporte],
                    ['id_producto', $request->id_producto]
                ])->first();
            if (!$soporte == null) {
                return response()->json('', 204);
            } else {
                Soporte::create($request->all());
                return response()->json('Soporte añadido');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $soporte = Soporte::where('id_soporte', $id)->get();
            if ($soporte->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $soporte;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $soporte = Soporte::where('id_soporte', $id)->get();
            if ($soporte->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $soporte;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $soporte = Soporte::where('id_soporte', $id)->get();
            if ($soporte->isEmpty()) {
                return response()->json('', 204);
            } else {
               Soporte::where('id_soporte', $id)->update($request->all());
               return response()->json('Soporte actualizado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $soporte = Soporte::where('id_soporte', $id)->get();
            if ($soporte->isEmpty()) {
                return response()->json('', 204);
            } else {
               Soporte::where('id_soporte', $id)->delete();
               return response()->json('Soporte eliminado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
