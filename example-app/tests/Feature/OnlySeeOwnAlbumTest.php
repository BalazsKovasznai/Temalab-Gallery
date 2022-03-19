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
}
