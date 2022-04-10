<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShareScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $album = \App\Models\Album::factory()->create();
        $response = $this->get('/albums/1/share');
        $response->assertStatus(200);
    }
    public function test_user_can_see_username_title()
    {
        $response = $this->get('/albums/1/share');
        $response->assertSee('Username');
    }
    public function test_user_can_see_share_button()
    {
        $response = $this->get('/albums/1/share');
        $response->assertSee('Share');
    }
}
