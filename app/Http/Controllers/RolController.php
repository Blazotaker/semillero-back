<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $rol = Rol::all();
            if ($rol->isEmpty()) {
                return response()->json("No hay nada para mostrar", 204);
            }
            return $rol;
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
            $Rol = Rol::where('rol', $request->rol)->get();
            if (!$Rol->isEmpty()) {
                return response()->json('', 221);
            } else {
                Rol::create($request->all());
                return response()->json("Rol creado");
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $Rol = Rol::where('id_rol', $id)->get();
            if ($Rol->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $Rol;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $Rol = Rol::find($id);
            if ($Rol == null) {
                return response()->json('', 204);
            } else {
                return $Rol;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Rol = Rol::where('id_rol', $id)->get();
            if ($Rol->isEmpty()) {
                return response()->json('', 204);
            } else {
                Rol::where('id_rol', $id)->update($request->all());
                return response()->json('Rol actualizado');
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Rol = Rol::where('id_rol', $id)->get();
            if ($Rol->isEmpty()) {
                return response()->json('', 204);
            } else {
                Rol::where('id_rol', $id)->delete();
                return response()->json('Rol eliminado');
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 222);
        }
    }
}
