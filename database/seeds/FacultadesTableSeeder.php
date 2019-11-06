<?php

use Illuminate\Database\Seeder;
use App\Facultad;

class FacultadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultades = ['Administración', 'Ciencias Agrarias','Ciencias Básicas, Sociales y Humanas'
        ,'Comunicación Audiovisual','Educación Física Recreación y Deporte','Ingeniería'
        ];
        foreach($facultades as $facultad){
            Facultad::insert([
                [
                    'facultad' => $facultad,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }

    }
}
