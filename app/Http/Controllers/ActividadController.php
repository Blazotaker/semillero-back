<?php

namespace App\Http\Controllers;

use App\actividad;
use App\Mes_actividad;
use Illuminate\Http\Request;
use DB;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $actividad = DB::table('actividades')
                ->join('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get();
            if ($actividad->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $actividad;
            }
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
            $actividad = Actividad::where([
                ['actividad', $request->actividad],
                ['id_periodo', $request->id_periodo]
            ])->get();
            if (!$actividad->isEmpty()) {
                return response()->json('', 221);
            } else {
                $actividad = Actividad::create($request->all());
                return $actividad->id_actividad;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $actividad = Actividad::where('id_actividad', $id)
                ->join('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get();
            if ($actividad->isEmpty()) {
                return response()->json('', 204);
            } else {
                $datos = [];
                $datos['actividad'] = $actividad;
                $mes_actividad = Mes_actividad::select('id_mes')->where('id_actividad', $id)->get();
                $datos['meses'] = [];
                $m1 = [];
                $i = 0;
                foreach ($mes_actividad as $mes) {
                    array_push($datos['meses'], (int) $mes['id_mes']);
                }
                return $datos;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
    public function actividadesPeriodoSemillero($id_periodo)
    {
        try {
            $actividades = collect(Actividad::select(
                'actividades.id_actividad',
                'actividad',
                'meses.id_mes',
                'actividades.responsable',
                'actividades.recursos',
                'actividades.registro',
                'actividades.estado'
            )->leftJoin('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
                ->leftJoin('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->leftJoin('mes_actividades', 'mes_actividades.id_actividad', 'actividades.id_actividad')
                ->leftJoin('meses', 'meses.id_mes', 'mes_actividades.id_mes')
                ->where('actividades.id_periodo', $id_periodo)
                ->get());
                $actividadesUnico = $actividades->unique('id_actividad');
                //return $actividadesUnico;
            if ($actividades->isEmpty()) {
                return response()->json('', 204);
            } else {
                $contenido = [];
                $datos = json_decode($actividadesUnico, true);

                //return $datos;
                $union = [];
                //return $datos;

                foreach ($datos as $dato) {
                    $i = 0;
                    $dato['meses'] = [];
                    $mes_actividad = Mes_actividad::select('id_mes')->where('id_actividad', $dato['id_actividad'])->get();
                    // return $actividad['id_actividad'];
                    $meses['meses'] = [];
                    foreach ($mes_actividad as $mes) {
                        array_push($meses['meses'], $mes['id_mes']);
                    }
                    //return $meses;
                    array_push($dato['meses'],$meses);
                    //return $dato;
                    array_push($contenido, $dato);
                    $i++;
                }
                return $contenido;
                return $actividades;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $actividad = Actividad::where('id_actividad', $id)
                ->join('periodos', 'periodos.id_periodo', 'actividades.id_periodo')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get();
            if ($actividad->isEmpty()) {
                return response()->json('', 204);
            } else {
                $datos = [];
                $datos['actividad'] = $actividad;
                $mes_actividad = Mes_actividad::select('id_mes')->where('id_actividad', $id)->get();
                $datos['meses'] = [];
                $m1 = [];
                $i = 0;
                foreach ($mes_actividad as $mes) {
                    array_push($datos['meses'], (int) $mes['id_mes']);
                }
                return $datos;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $actividad = Actividad::where('id_actividad', $id)
                ->get();
            if ($actividad->isEmpty()) {
                return response()->json('', 204);
            } else {
                Actividad::where('id_actividad', $id)
                    ->update($request->all());
                return response()->json("Actividad actualizada");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $actividad = Actividad::where('id_actividad', $id)
                ->get();
            if ($actividad->isEmpty()) {
                return response()->json('', 204);
            } else {
                Actividad::where('id_actividad', $id)
                    ->delete();
                return response()->json("Actividad eliminada");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
