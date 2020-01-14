<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * @test
     */
    public function it_shows_the_users_list()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Raúl')
            ->assertSee('Francisco');
    }

    /**
     * @test
     */
    public function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/users?empty')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /**
     * @test
     */
    public function it_loads_the_users_details_page(){
        $this->get('/users/5')
            ->assertStatus(200)
            ->assertSee('Usuario: 5');
    }

    /**
     * @test
     */
    public function it_loads_the_new_users_page(){
        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('Nuevo usuario');
    }

    /**
     * @test
     */
    public function it_loads_the_edit_users_page(){
        $this->get('/users/5/edit')
            ->assertStatus(200)
            ->assertSee('Editando al usuario: 5');
    }
}
 