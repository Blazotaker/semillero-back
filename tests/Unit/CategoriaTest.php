<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_categoria()
    {
        $response = $this->post('api/categoria/', array(
            'categoria' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Categoria creada'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_categoria_invalido()
    {
        $response = $this->post('api/categoria/', array(
            'categoria' => 'prueba'
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

    public function buscar_categoria_especifico()
    {
        $response = $this->get('api/categoria/7');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'categoria' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_categoria_especifico_no_existente()
    {
        $response = $this->get('api/categoria/9999');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function buscar_todos_los_categoria()
    {

        $response = $this->get('api/categoria/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'categoria' => 'prueba'
        ]);

    }
    /**
     *
     * @test
     */
    public function obtener_categoria_especifico()
    {
        $response = $this->get('api/categoria/7/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'categoria' => 'prueba'
        ]);
    }
    /**
     *
     * @test
     */
    public function obtener_categoria_especifico_no_existente()
    {
        $response = $this->get('api/categoria/999/edit');
        $response->assertStatus(204);


    }
    /**
     *
     * @test
     */
    public function actualizar_categoria()
    {
        $response = $this->put('api/categoria/7/', ['categoria' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Categoria actualizada'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_categoria_no_valido()
    {
        $response = $this->put('api/categoria/35/', ['categoria' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_categoria()
    {
        $response = $this->delete('api/categoria/7/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Categoria eliminada'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_categoria_no_valido()
    {
        $response = $this->delete('api/categoria/999/');
        $response->assertStatus(204);
    }
}
