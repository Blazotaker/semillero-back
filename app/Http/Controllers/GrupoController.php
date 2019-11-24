<?php

namespace App\Http\Controllers;

use App\Grupo;
use Illuminate\Http\Request;
use DB;
use Validator;

class grupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $grupo = DB::table('grupos')
                ->join('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->join('categorias', 'categorias.id_categoria', 'grupos.id_categoria')
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {

                return ($grupo);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function indexPublico()
    {
        try {
            $grupo = Grupo::select(
                'grupos.id_grupo',
                'grupos.grupo',
                'grupos.cod_colciencias',
                'categorias.categoria',
                'facultades.facultad',
                'grupos.vinculo',
                'usuarios.nombre_usuario',
                'usuarios.apellido_usuario',
                'usuarios.email',
                'usuarios.telefono'
            )
                ->leftJoin('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->leftJoin('categorias', 'categorias.id_categoria', 'grupos.id_categoria')
                ->leftJoin('directores', 'directores.id_grupo', 'grupos.id_grupo')
                ->leftJoin('usuarios', 'usuarios.id_usuario', 'directores.id_usuario')
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {

                return ($grupo);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function indexAvailable()
    {
        try {
            $grupo = Grupo::select('grupos.id_grupo', 'grupo', 'grupos.id_categoria', 'grupos.id_facultad')
                ->leftJoin('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->leftJoin('categorias', 'categorias.id_categoria', 'grupos.id_categoria')
                ->leftJoin('directores', 'directores.id_grupo', 'grupos.id_grupo')
                ->where('directores.id_director', null)
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {

                return ($grupo);
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
            $rules = [
                'grupo' => 'required|max:100',
                'id_categoria' => 'required',
                'cod_colciencias' => 'required',
                'id_facultad' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            $grupo = Grupo::where('grupo', $request->grupo)->get();
            if (!$grupo->isEmpty()) {
                return response()->json('', 221);
            } elseif ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            } else {
                Grupo::create($request->all());
                return response()->json("El grupo ha sido creado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $grupo = Grupo::where('id_grupo', $id)
                ->join('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->join('categorias', 'categorias.id_categoria', 'grupos.id_categoria')
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $grupo;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function showOnlyDirector($id_director)
    {
        try {
            $grupo = Grupo::select('grupo', 'cod_colciencias', 'facultad', 'categoria')
                ->where('id_director', $id_director)
                ->join('facultades', 'facultades.id_facultad', 'grupos.id_facultad')
                ->join('categorias', 'categorias.id_categoria', 'grupos.id_categoria')
                ->join('usuarios', 'usuarios.id_usuario', 'grupos.id_usuario')
                ->get();
            if ($grupo->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $grupo;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $grupo = Grupo::find($id);
            if ($grupo == null) {
                return response()->json('', 204);
            } else {
                return $grupo;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $grupo = Grupo::where('id_grupo', $id)->get();
            if ($grupo->isEmpty()) {
                return response('', 204);
            } else {
                Grupo::where('id_grupo', $id)->update($request->all());
                return response()->json("Grupo actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $grupo = Grupo::where('id_grupo', $id)->get();
            if ($grupo->isEmpty()) {
                return response('', 204);
            } else {
                Grupo::where('id_grupo', $id)->delete();
                return response()->json("Grupo eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }

}
