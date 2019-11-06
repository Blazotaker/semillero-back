<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'documento' => '10213',
                'nombre_usuario' => 'José Alejandro',
                'apellido_usuario' => 'Cortés Taborda',
                'email' => 'jose_cortes82141@elpoli.edu.co',
                'telefono' => '3052121',
                'estado' => 1,
                'id_tipo_usuario' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        User::insert([
            [
                'documento' => '121312321',
                'nombre_usuario' => 'Maicol',
                'apellido_usuario' => 'Duque Urrea',
                'email' => 'maicol_duque82141@elpoli.edu.co',
                'telefono' => '30523124',
                'estado' => 1,
                'id_tipo_usuario' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        User::insert([
            [
                'documento' => '56156',
                'nombre_usuario' => 'Brayan',
                'apellido_usuario' => 'Legarda Villegas',
                'email' => 'brayan_legarda82132@elpoli.edu.co',
                'telefono' => '30231321934',
                'estado' => 1,
                'id_tipo_usuario' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
