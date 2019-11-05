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
        if ($productos->isEmpty()) {
            return response('No hay actividades para mostrar', 404);
        } else {
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
        foreach ($productos as $producto) {
            $i = 0;
            $productos1 = Producto::where([
                ['id_proyecto', $request->id_proyecto],
                ['producto', $producto['producto']]
            ])->get();
            if (!$productos1->isEmpty()) {
                return response()->json('El producto ya ha sido asignado a la actividad', 201);
            } else {
                Producto::insert([
                    [
                        'producto' => $producto['producto'],
                        'id_tipo_producto' => $producto['id_tipo_producto'],
                        'id_proyecto' => $request->id_proyecto,
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
        $productos1 = Producto::where([
            ['id_proyecto', $request->id_proyecto],
            ['producto',$request->producto]
        ])->get();
        if (!$productos1->isEmpty()) {
            return response()->json('El producto ya ha sido asignado al proyecto', 201);
        } else {
            Producto::insert([
                [
                    'producto' => $request->producto,
                    'id_tipo_producto' => $request->id_tipo_producto,
                    'id_proyecto' => $request->id_proyecto,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

        return response()->json('Productos asignados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function showProductProject($id)
    {
        $producto_proyecto = Proyecto::where('productos.id_proyecto',$id)
        ->join('proyectos','proyectos.id_proyecto','productos.id_proyecto')
        ->first();
        if($producto_proyecto == null){
            return response()->json('no hay nada para mostrar',404);
        }

        return $producto_proyecto;
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
