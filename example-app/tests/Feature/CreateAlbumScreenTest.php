<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateAlbumScreenTest extends TestCase
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
        $response = $this->get('/albums/create');
        $response->assertStatus(200);
    }

    public function test_user_can_see_the_form()
    {
        $response = $this->get('/albums/create');
        $response->assertSeeInOrder(['Name', 'Description', 'Cover image']);
    }

}
