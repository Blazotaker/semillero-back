<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Tipo_productoTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_tipo_producto()
    {
        $response = $this->post('api/tipoproducto', array(
            'tipo_producto' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de producto creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_tipo_producto_invalido()
    {
        $response = $this->post('api/tipoproducto', array(
            'tipo_producto' => 'prueba'
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

    public function buscar_tipo_producto_especifico()
    {
        $response = $this->get('api/tipoproducto/6');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'tipo_producto' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_tipo_producto_especifico_no_existente()
    {
        $response = $this->get('api/tipoproducto/9999');
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
    public function buscar_todos_los_tipo_producto()
    {

        $response = $this->get('api/tipoproducto/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'tipo_producto' => 'prueba'
        ]);

        /* $response->assertJsonFragment([
            'tipo_producto' => 'prueba'
        ]); */
    }
    /**
     *
     * @test
     */
    public function obtener_tipo_producto_especifico()
    {
        $response = $this->get('api/tipoproducto/6/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'tipo_producto' => 'prueba'
        ]);
    }
    /**
     *
     * @test
     */
    public function obtener_tipo_producto_especifico_no_existente()
    {
        $response = $this->get('api/tipoproducto/999/edit');
        $response->assertStatus(204);

    }
    /**
     *
     * @test
     */
    public function actualizar_tipo_producto()
    {
        $response = $this->put('api/tipoproducto/6/', ['tipo_producto' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de producto actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_tipo_producto_no_valido()
    {
        $response = $this->put('api/tipoproducto/35/', ['tipo_producto' => 'Cambiado']);
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function eliminar_tipo_producto()
    {
        $response = $this->delete('api/tipoproducto/6/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de producto eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_tipo_producto_no_valido()
    {
        $response = $this->delete('api/tipoproducto/999/');
        $response->assertStatus(204);
    }
}
