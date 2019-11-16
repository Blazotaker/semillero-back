<?php

namespace App\Http\Controllers;

use App\proyecto;
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
                ->join('semilleros', 'semilleros.id_semillero', 'proyectos.id_semillero')
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
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
            return response($e->getMessage(), 404);
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
                'id_proyecto',
                'semillero',
                'proyecto',
                'vinculo'
                )->where('id_periodo', $id)
                ->leftJoin('periodos', 'periodos.id_periodo', 'proyectos.id_periodo')
                ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->leftJoin('productos', 'productos.id_proyecto', 'proyectos.id_proyecto')
                ->leftJoin('soportes', 'soportes.id_soporte', 'proyectos.id_soporte')
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
        }
    }

    public function show($id)
    {
        try {
            $proyecto = Proyecto::where('id_proyecto', $id)
                ->join('semilleros', 'semilleros.id_semillero', 'proyectos.id_semillero')
                ->get();
            if ($proyecto->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
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
                return response()->json('', 204);
            } else {
                return $proyecto;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
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
                return "Registro actualizado";
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
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
                return "Registro eliminado";
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 222);
        }
    }
}
