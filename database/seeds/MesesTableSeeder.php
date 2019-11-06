<?php

use Illuminate\Database\Seeder;
use App\Mes;

class MesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril',
            'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre'
        ];
        foreach ($meses as $mes) {
            Mes::insert([
                [
                    'mes' => $mes,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }
    }
}
