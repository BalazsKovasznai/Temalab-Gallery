<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SharedWithMeScreenTest extends TestCase
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


        $response = $this->get('/sharedwithme');
        $response->assertStatus(200);
    }

    public function test_new_user_can_see_no_shared_albums_yet()
    {

        $response = $this->get('/sharedwithme');
        $response->assertSee('No shared albums yet.');
    }

}
