<?php

namespace App\Http\Controllers;

use App\Director;
use Illuminate\Http\Request;
use DB;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $directores = DB::table('directores')
                ->leftJoin('usuarios', 'usuarios.id_usuario', 'directores.id_usuario')
                ->leftJoin('grupos', 'grupos.id_grupo', 'directores.id_grupo')
                ->get();
            if ($directores->isEmpty()) {
                return response()->json('', 204);
            }
            return $directores;
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
            $director = Director::where('id_usuario', $request->id_usuario)
                ->orWhere('id_grupo', $request->id_grupo)
                ->first();
            if (!$director == null) {
                if ($director->id_usuario == $request->id_usuario) {
                    return response()->json('El usuario ya es director de otro grupo', 221);
                } else {
                    return response()->json('El grupo ya tiene un director asignado', 221);
                }
            }
            Director::create($request->all());

            return response()->json('El usuario ha sido asignado como director');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $director = Director::where('id_director', $id)
                ->join('usuarios', 'usuarios.id_usuario', 'directores.id_usuario')
                ->join('directors', 'directors.id_director', 'directores.id_director')
                ->join('tipo_usuarios', 'tipo_usuarios.id_tipo_usuario', 'usuarios.id_tipo_usuario')
                /* ->join('roles','roles.id_rol','usuarios.id_rol')
        ->join('facultades','facultades.id_facultad','directors.id_facultad') */
                ->get();
            if ($director->isEmpty()) {
                return response()->json('', 204);
            }
            return $director;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $director = Director::find($id);
            if ($director == null) {
                return response()->json('', 204);
            }
            return $director;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $director = Director::where('id_usuario', $id)->get();
            if ($director->isEmpty()) {
                return response('', 204);
            } else {
                Director::where('id_usuario', $id)->update($request->all());
                return response()->json('Director actualizado', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $director = Director::where('id_usuario', $id)->get();
            if ($director->isEmpty()) {
                return response('', 204);
            } else {
                Director::where('id_usuario', $id)->delete();
                return response()->json('Director eliminado', 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
