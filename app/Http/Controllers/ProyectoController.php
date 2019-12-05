<?php

namespace App\Http\Controllers;

use App\proyecto;
use App\Periodo;
use Illuminate\Http\Request;
use DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $proyecto = DB::table('proyectos')
                ->join('periodos', 'periodos.id_periodo', 'proyectos.id_periodo')
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
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
            $proyecto = Proyecto::where([
                ['proyecto', $request->proyecto],
                ['id_periodo', $request->id_periodo]
            ])
                ->get();
            if (!$proyecto->isEmpty()) {
                return response()->json('El proyecto ya existe', 221);
            } else {
                Proyecto::create($request->all());
                return response()->json("Proyecto creado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function proyectoPeriodoSemillero($id)
    {
        try {
            $proyecto = Proyecto::select(
                'proyectos.id_proyecto',
                'proyectos.proyecto',
                'semilleros.semillero'
                /* 'proyectos.proyecto',
                'vinculo' */
            )->where('proyectos.id_periodo', $id)
                ->leftJoin('periodos', 'periodos.id_periodo', 'proyectos.id_periodo')
                ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                /* ->leftJoin('productos', 'productos.id_proyecto', 'proyectos.id_proyecto') */
                /* ->leftJoin('soportes', 'soportes.id_producto', 'productos.id_producto') */
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function showProyectosActual($id)
    {
        try {
            $periodo = Periodo::select('id_periodo')->where('semilleros.id_semillero', $id)->orderBy('periodos.created_at', 'DESC')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')->first();
            if ($periodo == null) {
                return response()->json('', 204);
            } else {
                $proyecto = Proyecto::select(
                    'proyectos.id_proyecto',
                    'proyectos.proyecto'
                    /* 'semilleros.semillero' */
                    /* 'proyectos.proyecto',
                'vinculo' */
                )->where('proyectos.id_periodo', $periodo->id_periodo)
                    ->leftJoin('periodos', 'periodos.id_periodo', 'proyectos.id_periodo')
                    /* ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero') */
                    /* ->leftJoin('productos', 'productos.id_proyecto', 'proyectos.id_proyecto') */
                    /* ->leftJoin('soportes', 'soportes.id_producto', 'productos.id_producto') */
                    ->get();
            }
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function show($id)
    {
        try {
            $proyecto = Proyecto::where('id_proyecto', $id)
                ->join('periodos', 'periodos.id_periodo', 'proyectos.id_periodo')
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $proyecto = Proyecto::find($id);
            if ($proyecto == null) {
                return response()->json()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $proyecto = Proyecto::where('id_proyecto', $id)
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                Proyecto::where('id_proyecto', $id)
                    ->update($request->all());
                return response()->json("Proyecto actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $proyecto = Proyecto::where('id_proyecto', $id)
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                proyecto::where('id_proyecto', $id)
                    ->delete();
                return response()->json("Proyecto eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
