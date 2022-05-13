<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\AlbumFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $user1 = User::factory()->create();

        Auth::login($user1);
        $album = \App\Models\Album::factory()->create();
        $this->post('/albums/store', [
            'name'=>$album->name,
            'description'=>$album->description,
            'user_id'=>$user1->id,
        ]);
        Auth::logout();

        $user2 = User::factory()->create();

        Auth::login($user2);
        $response = $this->get('/albums');
        $response->assertDontSee($album->name);
    }

    public function test_user_can_only_get_own_albums()
    {
        $user1 = User::factory()->create();
        Auth::login($user1);
        $album = \App\Models\Album::factory()->create();
        $this->post('/albums/store', [
            'name'=>$album->name,
            'description'=>$album->description,
            'user_id'=>$user1->id,
        ]);
        Auth::logout();

        $user2 = User::factory()->create();
        Auth::login($user2);

        $response = $this->get('/albums/'.$album->id);
        $response->assertDontSee($album->name);

    }


}
