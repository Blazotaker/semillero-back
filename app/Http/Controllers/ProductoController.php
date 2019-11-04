<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        if($productos->isEmpty()){
            return response('No hay actividades para mostrar',404);

        }else{
            return $productos;
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
        $productos = $request->productos;
        foreach($productos as $producto){
            $i = 0;
            $productos1 = Producto::where([
                ['id_actividad', $request->id_actividad],
                ['producto',$producto['producto']]
            ])->get();
            if(!$productos1->isEmpty()){
                return response()->json('El producto ya ha sido asignado a la actividad',201);
            }else{
                Producto::insert([
                    [
                        'producto' => $producto['producto'],
                        'id_tipo_producto' => $producto['id_tipo_producto'],
                        'id_actividad' => $request->id_actividad,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
                $i += 1;
            }
        }
        return response()->json('Productos asignados');
    }

    public function storeProject(Request $request)
    {
        $meses = $request->id_mes;
        foreach($meses as $mes){
            $i = 0;
            $Mes_actividades = Mes_actividad::where([
                ['id_actividad', $request->id_actividad],
                ['id_mes',$mes]
            ])->get();
            if(!$Mes_actividades->isEmpty()){
                return response()->json('El mes ya ha sido asignado a la actividad',201);
            }else{
                Mes_actividad::insert([
                    [
                        'id_actividad' => $request->id_actividad,
                        'id_mes' => $mes,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
                $i += 1;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(producto $producto)
    {
        //
    }
}
