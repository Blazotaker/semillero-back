<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoordinadorTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_coordinador()
    {
        $response = $this->post('api/coordinador/', array(
            'id_usuario' => 1,
            'id_semillero' => 1
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'El usuario ha sido asignado como coordinador'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_coordinador_invalido()
    {
        $response = $this->post('api/coordinador/', array(
            'id_usuario' => 1,
            'id_semillero' => 1
        ));
        $response->assertStatus(221);
        $response->assertJsonFragment([
            'El usuario ya es coordinador de otro semillero'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_coordinador_especifico()
    {
        $response = $this->get('api/coordinador/1');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_semillero' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_coordinador_especifico_no_existente()
    {
        $response = $this->get('api/coordinador/9999');
        $response->assertStatus(204);
        /* $response->assertJson([]); */
        /*  $response->assertJsonFragment([
            ''
         ]); */
    }

    /**
     *
     * @test
     */
    public function buscar_todos_los_coordinador()
    {

        $response = $this->get('api/coordinador/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_semillero' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_coordinador_especifico()
    {
        $response = $this->get('api/coordinador/1/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_semillero' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_coordinador_especifico_no_existente()
    {
        $response = $this->get('api/coordinador/999/edit');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function actualizar_coordinador()
    {
        $response = $this->put('api/coordinador/1/', ['id_coordinador' => 2]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Coordinador actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_coordinador_no_valido()
    {
        $response = $this->put('api/coordinador/99/', ['coordinador' => 2]);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_coordinador()
    {
        $response = $this->delete('api/coordinador/1/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Coordinador eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_coordinador_no_valido()
    {
        $response = $this->delete('api/coordinador/999/');
        $response->assertStatus(204);
    }
}
