<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrador','Director',
            'Coordinador','Participante'
        ];
        foreach ($roles as $rol) {
            Rol::insert([
                [
                    'rol' => $rol,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }
    }
}
