<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUser()
    {
        $response = $this->get('api/usuario/1');

        $response->assertStatus(200);
       //$response->assertJson(['']]);
       /* ->assertSee('nombre_usuario'); */
        //$this->assertTrue(true);
    }
}
