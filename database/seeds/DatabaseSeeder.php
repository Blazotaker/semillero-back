<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FacultadesTableSeeder::class,
            MesesTableSeeder::class,
            RolesTableSeeder::class,
            TipoProductoTableSeeder::class,
            TipoUsuarioTableSeeder::class,
            UsersTableSeeder::class,
            CategoriaSeeder::class
        ]);
    }
}
