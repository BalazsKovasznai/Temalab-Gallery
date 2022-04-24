<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\AlbumFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class OnlySeeOwnAlbumTest extends TestCase
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

        Auth::logout();

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->get('/albums');
        $response->assertDontSee($album->name);
    }

    public function test_user_can_only_get_own_albums()
    {
        $user1 = User::factory()->create();
        $this->post('/login', [
            'email' => $user1->email,
            'password' => 'password',
        ]);
        $album = \App\Models\Album::factory()->create();
        Auth::logout();

        $user2 = User::factory()->create();
        $this->post('/login', [
            'email' => $user2->email,
            'password' => 'password',
        ]);

        $response = $this->get('/albums/'.$album->id);
        $response->assertDontSee($album->name);

    }

    public function test_user_can_only_delete_own_albums()
    {
        $user1 = User::factory()->create();
        $this->post('/login', [
            'email' => $user1->email,
            'password' => 'password',
        ]);
        $album = \App\Models\Album::factory()->create();
        Auth::logout();

        $user2 = User::factory()->create();
        $this->post('/login', [
            'email' => $user2->email,
            'password' => 'password',
        ]);

        $this->delete('/albums/'.$album->id);
        $response = $this->get('/albums');
        $response->assertDontSee('Album deleted successfully');

    }

}
