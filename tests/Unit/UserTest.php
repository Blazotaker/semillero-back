<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User;

class UserTest extends TestCase
{

    /**
     *
     * @test
     */
    public function ingresar_usuario()
    {
        $response = $this->post('api/usuario', array(
            'documento' => '11111111',
            'nombre_usuario' => 'Usuario',
            'apellido_usuario' => 'Prueba',
            'email' => 'usuarioprueba@elpoli.edu.co',
            'telefono' => '3023132121',
            'estado' => 1,
            'id_tipo_usuario' => 1,
            'id_rol' => 4
        ));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            4
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_usuario_invalido_documento()
    {
        $response = $this->post('api/usuario', array(
            'documento' => '11111111',
            'nombre_usuario' => 'Usuario',
            'apellido_usuario' => 'Prueba',
            'email' => 'usuarioprueba213@elpoli.edu.co',
            'telefono' => '3023132121',
            'estado' => 1,
            'id_tipo_usuario' => 1,
            'id_rol' => 4
        ));
        $response->assertStatus(221);
        $response->assertJsonFragment([
            'Ya hay un usuario registrado con este documento'
        ]);
    }

    /**
     *
     * @test
     */
    public function ingresar_usuario_invalido_email()
    {
        $response = $this->post('api/usuario', array(
            'documento' => '5555555',
            'nombre_usuario' => 'Usuario',
            'apellido_usuario' => 'Prueba',
            'email' => 'usuarioprueba@elpoli.edu.co',
            'telefono' => '3023132121',
            'estado' => 1,
            'id_tipo_usuario' => 1,
            'id_rol' => 4
        ));
        $response->assertStatus(221);
        $response->assertJsonFragment([
            'Ya hay un usuario registrado con este email'
        ]);
    }

    /**
     *
     * @test
     */

    public function buscar_usuario_especifico()
    {
        $response = $this->get('api/usuario/4');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'documento' => '11111111',
            'email' => 'usuarioprueba@elpoli.edu.co'
        ]);
    }

    /**
     *
     * @test
     */
    public function buscar_usuario_especifico_no_existente()
    {
        $response = $this->get('api/usuario/9999');
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
    public function buscar_todos_los_usuarios()
    {

        $response = $this->get('api/usuario/');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'documento' => '11111111',
            'email' => 'usuarioprueba@elpoli.edu.co'
        ]);

    }
    /**
     *
     * @test
     */
    public function obtener_usuario_especifico()
    {
        $response = $this->get('api/usuario/4/edit');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'documento' => '11111111',
            'email' => 'usuarioprueba@elpoli.edu.co'
        ]);
    }
    /**
     *
     * @test
     */
    public function obtener_usuario_especifico_no_existente()
    {
        $response = $this->get('api/usuario/999/edit');
        $response->assertStatus(204);
    }

    /**
     *
     * @test
     */
    public function actualizar_usuario()
    {
        $response = $this->put('api/usuario/4/', ['nombre_usuario' => 'Cambiado']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Registro actualizado'
        ]);
    }

    /**
     *
     * @test
     */
    public function actualizar_usuario_no_valido()
    {
        $response = $this->put('api/usuario/9999/', ['nombre_usuario' => 'Cambiado']);
        $response->assertStatus(204);

    }

    /**
     *
     * @test
     */
    public function eliminar_usuario()
    {
        $response = $this->delete('api/usuario/4/');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'Registro eliminado'
        ]);
    }

    /**
     *
     * @test
     */
    public function eliminar_usuario_no_valido()
    {
        $response = $this->delete('api/usuario/999/');
        $response->assertStatus(204);

    }
}
