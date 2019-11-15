<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacultadTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_facultad()
    {
        $response = $this->post('api/facultad/', array(
            'facultad' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Facultad creada'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_facultad_invalido()
    {
        $response = $this->post('api/facultad/', array(
            'facultad' => 'prueba'
        ));
        $response->assertStatus(400);
        $response->assertJsonFragment([
            ''
        ]);
    }
    /**
     *
     * @test
     */

    public function buscar_facultad_especifico()
    {
        $response = $this->get('api/facultad/1');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'facultad' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_facultad_especifico_no_existente()
    {
        $response = $this->get('api/facultad/9999');
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);
        /* $response->assertJson([]); */
        /*  $response->assertJsonFragment([
            ''
         ]); */
    }

    /**
     *
     * @test
     */
    public function buscar_todos_los_facultad()
    {

        $response = $this->get('api/facultad/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'facultad' => 'prueba'
        ]);

        /* $response->assertJsonFragment([
            'facultad' => 'prueba'
        ]); */
    }
    /**
     *
     * @test
     */
    public function obtener_facultad_especifico()
    {
        $response = $this->get('api/facultad/1/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'facultad' => 'prueba'
        ]);
    }
    /**
     *
     * @test
     */
    public function obtener_facultad_especifico_no_existente()
    {
        $response = $this->get('api/facultad/999/edit');
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);

    }
    /**
     *
     * @test
     */
    public function actualizar_facultad()
    {
        $response = $this->put('api/facultad/1/', ['facultad' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Facultad actualizada'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_facultad_no_valido()
    {
        $response = $this->put('api/facultad/35/', ['facultad' => 'Cambiado']);
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_facultad()
    {
        $response = $this->delete('api/facultad/1/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Facultad eliminada'
        ]);
    }

      /**
     *
     * @test
     */
    public function eliminar_facultad_no_valido()
    {
        $response = $this->delete('api/facultad/999/');
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);
    }
}
