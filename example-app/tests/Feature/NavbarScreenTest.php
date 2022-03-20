<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NavbarScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_create_album_button()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->get('/dashboard');
        $response->assertSee('Create Album');
    }
    public function test_user_can_see_shared_with_me_button()
    {
        $response = $this->get('/dashboard');
        $response->assertSee('Shared With Me');
    }
}
