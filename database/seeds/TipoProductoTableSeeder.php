<?php

use Illuminate\Database\Seeder;
use App\Tipo_producto;

class TipoProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_productos = [
            'Trabajo de grado','Ponencia',
            'Articulo','Patente','Presentación'
        ];
        foreach ($tipo_productos as $tipo_producto) {
            Tipo_producto::insert([
                [
                    'tipo_producto' => $tipo_producto,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }
    }
}
