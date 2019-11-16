<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'A1','A','B','C','D','No reconocido'
        ];
        foreach ($categorias as $categoria) {
            Categoria::insert([
                [
                    'categoria' => $categoria,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }
    }
}
