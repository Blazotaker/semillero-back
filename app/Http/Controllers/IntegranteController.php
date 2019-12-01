<?php

namespace App\Http\Controllers;

use App\Integrante;
use App\Periodo;
use Illuminate\Http\Request;
use DB;

class IntegranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $integrante = DB::table('integrantes')
                ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
                ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
                ->get();
            if ($integrante->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $integrante;
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
            //Se debe revisar
            $integrante = Integrante::where([
                ['id_usuario', $request->id_usuario],
                ['id_periodo', $request->id_periodo]
            ])->get();
            if (!$integrante->isEmpty()) {
                return response()->json('El integrante ya existe', 221);
            } else {
                Integrante::create($request->all());
                return "Integrante creado";
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $integrante = Integrante::where('id_integrante', $id)
                ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
                ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
                ->get();
            if ($integrante->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $integrante;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function showSemilleroPeriodo($id)
    {
        try {
            $integrante = Integrante::where('integrantes.id_periodo', $id)
                ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
                ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                ->get();
            if ($integrante->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $integrante;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function showSemilleroNoPeriodoActual($id)
    {
        try {
            $integrante = collect(Integrante::where('integrantes.id_periodo', '<>', $id)
                ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
                ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                ->get());
                $datos = $integrante->unique('usuarios.id_usuario');
            if ($datos->isEmpty()) {
                return response()->json('Nada para mostrar', 204);
            } else {
                return $datos;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    public function showIntegrantesActual($id)
    {
        try {

            $periodo = Periodo::select('id_periodo')->where('semilleros.id_semillero', $id)->orderBy('periodos.created_at', 'DESC')
                ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')->first();
            if ($periodo == null) {
                return response()->json('', 204);
            } else {
                $integrante = Integrante::where('integrantes.id_periodo', $periodo->id_periodo)
                    ->join('usuarios', 'usuarios.id_usuario', 'integrantes.id_usuario')
                    ->join('periodos', 'periodos.id_periodo', 'integrantes.id_periodo')
                    ->join('semilleros', 'semilleros.id_semillero', 'periodos.id_semillero')
                    ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                    ->get();
            }
            if ($integrante->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $integrante;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $integrante = Integrante::find($id);
            if ($integrante == null) {
                return response()->json('', 204);
            } else {
                return "Integrante creado";
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $integrante = Integrante::where('id_integrante', $id)
                ->get();
            if ($integrante->isEmpty()) {
                return response()->json('', 204);
            } else {
                Integrante::where('id_integrante', $id)->update($request->all());
                return response()->json("Integrante actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\integrante  $integrante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $integrante = Integrante::where('id_usuario', $id)
                ->get();
            if ($integrante->isEmpty()) {
                return response()->json()->json('', 204);
            } else {
                Integrante::where([
                    ['id_usuario', $id],


                ])->delete();
                return response()->json()->json("Integrante eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }

    public function deleteIntegrantePeriodo(Request $request)
    {
        try {
            $integrante = Integrante::where(
                ['id_usuario', $request->id_periodo],
                ['id_periodo', $request->id_periodo]
            )->get();
            if ($integrante->isEmpty()) {
                return response()->json()->json('', 204);
            } else {
                Integrante::where([
                    ['id_usuario', $request->id_periodo],
                    ['id_periodo', $request->id_periodo]

                ])->delete();
                return response()->json()->json("Integrante eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
