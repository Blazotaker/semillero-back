<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;
use DB;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $periodos = Periodo::select('periodos.id_periodo', 'periodo', 'fecha_inicio', 'fecha_fin', 'semillero', 'semilleros.id_semillero')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get();
            if ($periodos->isEmpty()) {
                return response()->json('', 204);
            }
            return $periodos;
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
            $periodo = Periodo::where([
                ['periodo', $request->periodo],
                ['id_semillero', $request->id_semillero]
            ])->get();
            if (!$periodo->isEmpty()) {
                return response()->json('', 221);
            } else {
                $periodo = Periodo::create($request->all());
                $dato = Periodo::select('periodos.id_periodo',
                'periodo',
                'fecha_inicio',
                'fecha_fin',
                'semilleros.semillero',
                'semilleros.id_semillero')->join('semilleros','semilleros.id_semillero','periodos.id_semillero')
                ->where('id_periodo',$periodo->id_periodo)->first();
                return $dato;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $periodo = Periodo::select('periodos.id_periodo', 'periodo', 'fecha_inicio', 'fecha_fin', 'semillero', 'semilleros.id_semillero')
                ->where('semilleros.id_semillero', $id)
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get();
            if ($periodo->isEmpty()) {
                return response('', 204);
            } else {
                return $periodo;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $periodo = Periodo::find($id);
            if ($periodo == null) {
                return response()->json('', 204);
            } else {
                return $periodo;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $periodo = Periodo::where('id_periodo', $id)->get();
            if ($periodo->isEmpty()) {
                return response()->json('', 204);
            } else {
                Periodo::where('id_periodo', $id)->update($request->all());
                return response()->json("Periodo actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $periodo = Periodo::where('id_periodo', $id)->get();
            if ($periodo->isEmpty()) {
                return response()->json('', 204);
            } else {
                Periodo::where('id_periodo', $id)->delete();
                return response()->json("Periodo eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
