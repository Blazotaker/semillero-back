<?php

use Illuminate\Database\Seeder;
use App\Tipo_usuario;

class TipoUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tipo_usuarios = [
            'Estudiante','Docente','Egresado',
            'Administrativo','Particular'
        ];
        foreach ($Tipo_usuarios as $tipo_usuario) {
            Tipo_usuario::insert([
                [
                    'tipo_usuario' => $tipo_usuario,
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            ]);
        }
    }
}
