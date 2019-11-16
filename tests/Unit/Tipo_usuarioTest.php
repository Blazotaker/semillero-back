<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Tipo_usuarioTest extends TestCase
{
    /**
     *
     * @test
     */
    public function ingresar_tipo_usuario()
    {
        $response = $this->post('api/tipousuario', array(
            'tipo_usuario' => 'prueba'
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de usuario creado'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_tipo_usuario_invalido()
    {
        $response = $this->post('api/tipousuario', array(
            'tipo_usuario' => 'prueba'
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

    public function buscar_tipo_usuario_especifico()
    {
        $response = $this->get('api/tipousuario/6/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'tipo_usuario' => 'prueba'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_tipo_usuario_especifico_no_existente()
    {
        $response = $this->get('api/tipousuario/9999');
        $response->assertStatus(204);
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
    public function buscar_todos_los_tipo_usuario()
    {

        $response = $this->get('api/tipousuario/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'tipo_usuario' => 'prueba'
        ]);

        $response->assertJsonFragment([
            'tipo_usuario' => 'Estudiante'
        ]);
        /* $response->assertJsonFragment([
            'tipo_usuario' => 'prueba'
        ]); */
    }


    /**
     *
     * @test
     */
    public function obtener_tipo_usuario_especifico()
    {
        $response = $this->get('api/tipousuario/6/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'tipo_usuario' => 'prueba'
        ]);
    }


    /**
     *
     * @test
     */
    public function obtener_tipo_usuario_especifico_no_existente()
    {
        $response = $this->get('api/tipousuario/999/edit');
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);

    }
    /**
     *
     * @test
     */
    public function actualizar_tipo_usuario()
    {
        $response = $this->put('api/tipousuario/6/', ['tipo_usuario' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de usuario actualizado'
        ]);
    }
    /**
     *
     * @test
     */
    public function actualizar_tipo_usuario_no_valido()
    {
        $response = $this->put('api/tipousuario/35/', ['tipo_usuario' => 'Cambiado']);
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_tipo_usuario()
    {
        $response = $this->delete('api/tipousuario/6/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Tipo de usuario eliminado'
        ]);
    }

      /**
     *
     * @test
     */
    public function eliminar_tipo_usuario_no_valido()
    {
        $response = $this->delete('api/tipousuario/999/');
        $response->assertStatus(404);
        $response->assertJsonFragment([
            ''
        ]);
    }
}
