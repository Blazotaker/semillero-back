<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SemilleroTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_semillero()
    {
        $response = $this->post('api/semillero/', array(
            'semillero' => 'Semillero Prueba',
            'objetivo' => 'prueba',
            'descripcion' => 'prueba',
            'id_grupo' => 1
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'El semillero ha sido creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_semillero_invalido()
    {
        $response = $this->post('api/semillero/', array(
            'semillero' => 'Semillero Prueba',
            'objetivo' => 'prueba',
            'descripcion' => 'prueba',
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
    public function buscar_semillero_especifico()
    {
        $response = $this->get('api/semillero/1');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'semillero' => 'Semillero Prueba',
            'objetivo' => 'prueba',
            'descripcion' => 'prueba',
            'id_grupo' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_semillero_especifico_no_existente()
    {
        $response = $this->get('api/semillero/9999');
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
    public function buscar_todos_los_semillero()
    {

        $response = $this->get('api/semillero/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'semillero' => 'Semillero Prueba',
            'objetivo' => 'prueba',
            'descripcion' => 'prueba',
            'id_grupo' => 1
        ]);

        /* $response->assertJsonFragment([
            'semillero' => 'prueba'
        ]); */
    }

    /**
     *
     * @test
     */
    public function obtener_semillero_especifico()
    {
        $response = $this->get('api/semillero/1/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'semillero' => 'Semillero Prueba',
            'objetivo' => 'prueba',
            'descripcion' => 'prueba',
            'id_grupo' => 1
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_semillero_especifico_no_existente()
    {
        $response = $this->get('api/semillero/999/edit');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function actualizar_semillero()
    {
        $response = $this->put('api/semillero/1/', ['semillero' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Semillero actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_semillero_no_valido()
    {
        $response = $this->put('api/semillero/99/', ['semillero' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_semillero()
    {
        $response = $this->delete('api/semillero/1/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Semillero eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_semillero_no_valido()
    {
        $response = $this->delete('api/semillero/999/');
        $response->assertStatus(204);
    }
}
