<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DirectorTest extends TestCase
{
     /**
     *
     * @test
     */
    public function ingresar_director()
    {
        $response = $this->post('api/director/', array(
            'id_usuario' => 1,
            'id_grupo' => 1
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'El usuario ha sido asignado como director'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_director_invalido()
    {
        $response = $this->post('api/director/', array(
            'id_usuario' => 1,
            'id_grupo' => 1
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
    public function buscar_director_especifico()
    {
        $response = $this->get('api/director/1');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_grupo' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_director_especifico_no_existente()
    {
        $response = $this->get('api/director/9999');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function buscar_todos_los_director()
    {

        $response = $this->get('api/director/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_grupo' => 1
        ]);

        /* $response->assertJsonFragment([
            'director' => 'prueba'
        ]); */
    }

    /**
     *
     * @test
     */
    public function obtener_director_especifico()
    {
        $response = $this->get('api/director/1/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_grupo' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_director_especifico_no_existente()
    {
        $response = $this->get('api/director/999/edit');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function actualizar_director()
    {
        $response = $this->put('api/director/1/', ['director' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Director actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_director_no_valido()
    {
        $response = $this->put('api/director/99/', ['director' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_director()
    {
        $response = $this->delete('api/director/1/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Director eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_director_no_valido()
    {
        $response = $this->delete('api/director/999/');
        $response->assertStatus(204);
    }
}
