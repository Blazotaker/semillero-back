<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MesTest extends TestCase
{

     /**
     *
     * @test
     */
    public function ingresar_mes()
    {
        $response = $this->post('api/mes/', array(
            'mes' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Mes creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_mes_invalido()
    {
        $response = $this->post('api/mes/', array(
            'mes' => 'prueba'
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
    public function buscar_mes_especifico()
    {
        $response = $this->get('api/mes/13');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'mes' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_mes_especifico_no_existente()
    {
        $response = $this->get('api/mes/9999');
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
    public function buscar_todos_los_mes()
    {

        $response = $this->get('api/mes/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'mes' => 'prueba'
        ]);

        /* $response->assertJsonFragment([
            'mes' => 'prueba'
        ]); */
    }

    /**
     *
     * @test
     */
    public function obtener_mes_especifico()
    {
        $response = $this->get('api/mes/13/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'mes' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function obtener_mes_especifico_no_existente()
    {
        $response = $this->get('api/mes/999/edit');
        $response->assertStatus(204);

    }

    /**
     *
     * @test
     */
    public function actualizar_mes()
    {
        $response = $this->put('api/mes/13/', ['mes' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Mes actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_mes_no_valido()
    {
        $response = $this->put('api/mes/99/', ['mes' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_mes()
    {
        $response = $this->delete('api/mes/13/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Mes eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_mes_no_valido()
    {
        $response = $this->delete('api/mes/999/');
        $response->assertStatus(204);
    }
}
