<?php

namespace App\Http\Controllers;

use App\Tipo_usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tipo_usuarios =  Tipo_usuario::all();
            if ($tipo_usuarios->isEmpty()) {
                return response()->json('', 404);
            }
            return $tipo_usuarios;
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
            $tipo_usuario = Tipo_usuario::where('tipo_usuario', $request->tipo_usuario)->get();
            if (!$tipo_usuario->isEmpty()) {
                return response()->json('', 400);
            } else {
                Tipo_usuario::create($request->all());
                return response()->json('Tipo de usuario creado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tipo_usuario = Tipo_usuario::where('id_tipo_usuario', $id)->get();
            if ($tipo_usuario->isEmpty()) {
                return response()->json('', 404);
            } else {
                return $tipo_usuario;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tipo_usuario = Tipo_usuario::find($id);
            if ($tipo_usuario == null) {
                return response()->json('', 404);
            } else {
                return $tipo_usuario;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tipo_usuario = Tipo_usuario::where('id_tipo_usuario', $id)->get();
            if ($tipo_usuario->isEmpty()) {
                return response()->json('', 404);
            } else {
                Tipo_usuario::where('id_tipo_usuario', $id)->update($request->all());
                return response()->json('Tipo de usuario actualizado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipo_usuario = Tipo_usuario::where('id_tipo_usuario', $id)->get();
            if ($tipo_usuario->isEmpty()) {
                return response()->json('', 404);
            } else {
                Tipo_usuario::where('id_tipo_usuario', $id)->delete();
                return response()->json('Tipo de usuario eliminado');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
