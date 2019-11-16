<?php

namespace App\Http\Controllers;

use App\Coordinador;
use Illuminate\Http\Request;
use DB;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $coordinadores = DB::table('coordinadores')
                ->join('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
                ->join('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                ->get();
            if ($coordinadores->isEmpty()) {
                return response()->json('', 204);
            }
            return $coordinadores;
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
            $coordinador = Coordinador::where('id_usuario', $request->id_usuario)->get();
            if (!$coordinador->isEmpty()) {
                return response()->json('El usuario ya es coordinador de otro semillero', 221);
            }
            Coordinador::create($request->all());

            return response()->json('El usuario ha sido asignado como coordinador', 221);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $coordinador = Coordinador::where('id_coordinador', $id)
                ->join('usuarios', 'usuarios.id_usuario', 'coordinadores.id_usuario')
                ->join('semilleros', 'semilleros.id_semillero', 'coordinadores.id_semillero')
                ->get();
            if ($coordinador->isEmpty()) {
                return response()->json('', 204);
            }
            return $coordinador;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $coordinadores = Coordinador::find($id)
                ->get();
            if ($coordinadores == null) {
                return response()->json('', 204);
            } else {
                return $coordinadores;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $coordinadores = Coordinador::where('id_usuario', $id)
                ->get();
            if ($coordinadores->isEmpty()) {
                return response()->json('', 204);
            } else {
                Coordinador::where('id_coordinador', $id)->update($request->all());
                return response()->json('Registro actualizado', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $coordinadores = Coordinador::where('id_coordinador', $id)
            ->get();
        if ($coordinadores->isEmpty()) {
            return response()->json('', 204);
        } else {
            Coordinador::where('id_coordinador', $id)->delete();
            return response()->json('Registro eliminado', 200);
        }
    } catch (\Exception $e) {
        return response()->json($e->getMessage(), 222);
    }
    }
}
