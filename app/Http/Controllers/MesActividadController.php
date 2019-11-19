<?php

namespace App\Http\Controllers;

use App\Mes_actividad;
use Illuminate\Http\Request;

class MesActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $mes_actividades = Mes_actividad::all();
            if ($mes_actividades->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $mes_actividades;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
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
            $datos = json_decode($request->getContent(), true);
            foreach ($datos as $dato) {
                $i = 0;
                $Mes_actividades = Mes_actividad::where([
                    ['id_actividad', $dato['id_actividad']],
                    ['id_mes', $dato['id_mes']]
                ])->get();
                if (!$Mes_actividades->isEmpty()) {
                    return response()->json("El mes ya ha sido asignado a la actividad", 221);
                } else {
                    Mes_actividad::insert([
                        [
                            "id_actividad" => $dato['id_actividad'],
                            "id_mes" => $dato['id_mes'],
                            "created_at" => now(),
                            "updated_at" => now()
                        ]
                    ]);
                    $i += 1;
                }
            }

            return response()->json("Meses asignados");
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mes_actividad  $mes_actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $mes_actividades = Mes_actividad::where('id_actividad', $id)->get();
            if ($mes_actividades->isEmpty()) {
                return response('', 204);
            } else {
                $meses = [];
                foreach ($mes_actividades as $mes_actividad) {
                    array_push($meses, $mes_actividad->id_mes);
                }
                return response()->json($meses);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mes_actividad  $mes_actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $mes_actividades = Mes_actividad::where('id_actividad', $id)->get();
            if ($mes_actividades->isEmpty()) {
                return response('', 204);
            } else {
                $meses = [];
                foreach ($mes_actividades as $mes_actividad) {
                    array_push($meses, $mes_actividad->id_mes);
                }
                return response()->json($meses);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mes_actividad  $mes_actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $datos = json_decode($request->getContent(), true);
            $mes_actividades = Mes_actividad::where('id_actividad', $id)
                ->get();
            if ($mes_actividades->isEmpty()) {
                return response()->json('', 204);
            } else {
                $mes_actividades = Mes_actividad::where('id_actividad', $id)->delete();
                foreach ($datos as $dato) {
                    Mes_actividad::insert([
                        [
                            "id_actividad" => $dato['id_actividad'],
                            "id_mes" => $dato['id_mes'],
                            "created_at" => now(),
                            "updated_at" => now()
                        ]
                    ]);
                }
                return response()->json('Meses actualizados');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mes_actividad  $mes_actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mes_actividad $mes_actividad)
    {
        //
    }
}
