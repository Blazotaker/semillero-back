<?php

namespace App\Http\Controllers;

use App\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $facultad =  Facultad::all();
            if ($facultad->isEmpty()) {
                return response()->json('', 204);
            }
            return $facultad;
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
            $facultad = Facultad::where('facultad', $request->facultad)->get();
            if (!$facultad->isEmpty()) {
                return response()->json('',221);
            } else {
                Facultad::create($request->all());
                return response()->json('Facultad creada');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $facultad = Facultad::where('id_facultad', $id)->get();
            if ($facultad->isEmpty()) {
                return response()->json('',204);
            } else {
                return $facultad;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $facultad = Facultad::find($id);
            if ($facultad == null) {
                return response()->json('', 204);
            } else {
                return $facultad;
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $facultad = Facultad::where('id_facultad', $id)->get();
            if ($facultad->isEmpty()) {
                return response()->json('', 204);
            } else {
                Facultad::where('id_facultad', $id)->update($request->all());
                return response()->json('Facultad actualizada');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $facultad = Facultad::where('id_facultad', $id)->get();
            if ($facultad->isEmpty()) {
                return response()->json('', 204);
            } else {
                Facultad::where('id_facultad', $id)->delete();
                return response()->json('Facultad eliminada');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
