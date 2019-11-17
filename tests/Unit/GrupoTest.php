<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GrupoTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_grupo()
    {
        $response = $this->post('api/grupo/', array(
            'grupo' => 'grupo',
            'id_categoria' => 1,
            'cod_colciencias' => 'A1456',
            'id_facultad' => 1,
            'vinculo' => 'prueba.com'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'El grupo ha sido creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_grupo_invalido()
    {
        $response = $this->post('api/grupo/', array(
            'grupo' => 'grupo',
            'id_categoria' => 1,
            'cod_colciencias' => 'A1456',
            'id_facultad' => 1,
            'vinculo' => 'prueba.com'
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
    public function buscar_grupo_especifico()
    {
        $response = $this->get('api/grupo/2');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'grupo' => 'grupo',
            'id_categoria' => 1,
            'cod_colciencias' => 'A1456',
            'id_facultad' => 1,
            'vinculo' => 'prueba.com'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_grupo_especifico_no_existente()
    {
        $response = $this->get('api/grupo/9999');
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
    public function buscar_todos_los_grupo()
    {

        $response = $this->get('api/grupo/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'grupo' => 'grupo',
            'id_categoria' => 1,
            'cod_colciencias' => 'A1456',
            'id_facultad' => 1,
            'vinculo' => 'prueba.com'
        ]);

        /* $response->assertJsonFragment([
            'grupo' => 'prueba'
        ]); */
    }

    /**
     *
     * @test
     */
    public function obtener_grupo_especifico()
    {
        $response = $this->get('api/grupo/2/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'grupo' => 'grupo',
            'id_categoria' => 1,
            'cod_colciencias' => 'A1456',
            'id_facultad' => 1,
            'vinculo' => 'prueba.com'
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_grupo_especifico_no_existente()
    {
        $response = $this->get('api/grupo/999/edit');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function actualizar_grupo()
    {
        $response = $this->put('api/grupo/2/', ['grupo' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Grupo actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_grupo_no_valido()
    {
        $response = $this->put('api/grupo/99/', ['grupo' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_grupo()
    {
        $response = $this->delete('api/grupo/2/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Grupo eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_grupo_no_valido()
    {
        $response = $this->delete('api/grupo/999/');
        $response->assertStatus(204);
    }
}
