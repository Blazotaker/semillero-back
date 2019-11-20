<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use App\Soporte;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $productos = Producto::all();
            if ($productos->isEmpty()) {
                return response()->json('', 204);
            } else {
                return $productos;
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
        /* try {
            $productos = $request->productos;
            foreach ($productos as $producto) {
                $i = 0;
                $productos1 = Producto::where([
                    ['id_producto', $request->id_proyecto],
                    ['producto', $producto['producto']]
                ])->get();
                if (!$productos1->isEmpty()) {
                    return response()->json('El producto ya ha sido asignado a la producto', 221);
                } else {
                    Producto::insert([
                        [
                            'producto' => $producto['producto'],
                            'id_tipo_producto' => $producto['id_tipo_producto'],
                            'id_producto' => $request->id_producto,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    ]);
                    $i += 1;
                }
            }
            return response()->json('Productos asignados');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        } */ }

    public function show($id)
    {
        try {
            $producto_producto = Producto::select(
                'productos.id_producto',
                'producto',
                'tipo_productos.id_tipo_producto',
                'proyectos.id_proyecto',
                'actividades.id_actividad',
                'actividad',
                'responsable',
                'recursos',
                'registro',
                'estado',
                'proyectos.id_periodo as proyectoPeriodo',
                'actividades.id_periodo as actividadPeriodo',
                'proyecto',
                'tipo_productos.tipo_producto',
                'id_soporte',
                'vinculo')->
            where('productos.id_producto', $id)
                ->leftJoin('actividades', 'actividades.id_actividad', 'productos.id_actividad')
                ->leftJoin('proyectos', 'proyectos.id_proyecto', 'productos.id_proyecto')
                ->leftJoin('tipo_productos', 'tipo_productos.id_tipo_producto', 'productos.id_tipo_producto')
                ->leftJoin('soportes', 'soportes.id_producto', 'productos.id_producto')
                ->get();
            if ($producto_producto == null) {
                return response()->json('', 204);
            }
            return $producto_producto;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    public function storeActivity(Request $request)
    {
        try {
            $productos1 = Producto::where([
                ['id_producto', $request->id_producto],
                ['producto', $request->producto]
            ])->get();
            if (!$productos1->isEmpty()) {
                return response()->json('', 204);
            } else {
                Producto::insert([
                    [
                        'producto' => $request->producto,
                        'id_tipo_producto' => $request->id_tipo_producto,
                        'id_producto' => $request->id_producto,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
            }

            return response()->json('Productos asignados');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }




    public function storeProject(Request $request)
    {
        try {
            $productos1 = Producto::where([
                ['id_proyecto', $request->id_proyecto],
                ['producto', $request->producto]
            ])->get();
            if (!$productos1->isEmpty()) {
                return response()->json('', 204);
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
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */

    public function showProductActivity($id)
    {
        //Cambié 17/11/2019 porque decia solo producto en el where
        try {
            $producto_producto = Producto::where('productos.id_producto', $id)
                ->leftJoin('actividades', 'actividades.id_actividad', 'productos.id_actividad')
                ->leftJoin('tipo_productos', 'tipo_productos.id_tipo_producto', 'productos.id_tipo_producto')
                ->leftJoin('soportes', 'soportes.id_producto', 'productos.id_producto')
                ->get();
            if ($producto_producto == null) {
                return response()->json('', 204);
            }
            return $producto_producto;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
    public function showProductProject($id)
    {
        try {
            $producto_proyecto = Producto::select('productos.id_producto', 'productos.producto', 'tipo_productos.tipo_producto', 'soportes.vinculo')
                ->leftJoin('proyectos', 'proyectos.id_proyecto', 'productos.id_proyecto')
                ->leftJoin('tipo_productos', 'tipo_productos.id_tipo_producto', 'productos.id_producto')
                ->leftJoin('soportes', 'soportes.id_producto', 'productos.id_producto')
                ->where('productos.id_proyecto', $id)
                ->get();
            if ($producto_proyecto == null) {
                return response()->json('', 204);
            }

            return $producto_proyecto;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $producto = Producto::where('productos.id_producto', $id)
                ->get();
            if ($producto == null) {
                return response()->json('', 204);
            }

            return $producto;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $producto = Producto::where('id_producto', $id)
                ->get();
            if ($producto->isEmpty()) {
                return response()->json('', 204);
            } else {
                Producto::where('id_producto', $id)->update($request->all());
                return response()->json("Producto actualizado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::where('id_producto', $id)
                ->first();
            if ($producto == null) {
                return response()->json('', 204);
            } else {
                Soporte::where('id_producto', $producto->id_producto)
                    ->delete();
                Producto::where('id_producto', $id)
                    ->delete();
                return response()->json("Producto eliminado");
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 222);
        }
    }
}
