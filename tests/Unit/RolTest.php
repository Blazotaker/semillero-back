<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolTest extends TestCase
{
    
     /**
     *
     * @test
     */
    public function ingresar_rol()
    {
        $response = $this->post('api/rol', array(
            'rol' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Rol creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_rol_invalido()
    {
        $response = $this->post('api/rol', array(
            'rol' => 'prueba'
        ));
        $response->assertStatus(221);
        $response->assertJsonFragment([
            ''
        ]);
    }

    /**
     *
     * @test
     */

    public function buscar_rol_especifico()
    {
        $response = $this->get('api/rol/5');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'rol' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_rol_especifico_no_existente()
    {
        $response = $this->get('api/rol/9999');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function buscar_todos_los_rol()
    {

        $response = $this->get('api/rol/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'rol' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_rol_especifico()
    {
        $response = $this->get('api/rol/5/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'rol' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_rol_especifico_no_existente()
    {
        $response = $this->get('api/rol/999/edit');
        $response->assertStatus(204);


    }

    /**
     *
     * @test
     */
    public function actualizar_rol()
    {
        $response = $this->put('api/rol/5/', ['rol' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Rol actualizado'
        ]);
    }

    /**
     *
     * @test
     */
    public function actualizar_rol_no_valido()
    {
        $response = $this->put('api/rol/35/', ['rol' => 'Cambiado']);
        $response->assertStatus(204);

    }

    /**
     *
     * @test
     */
    public function eliminar_Rol()
    {
        $response = $this->delete('api/rol/5/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Rol eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_Rol_no_valido()
    {
        $response = $this->delete('api/rol/999/');
        $response->assertStatus(204);

    }
}
