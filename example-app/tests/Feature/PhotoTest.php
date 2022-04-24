<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class PhotoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $photo = \App\Models\Photo::factory()->create();

        $response = $this->get('/albums/1');
        $response->assertSee($photo->title);
    }

    public function test_user_can_only_get_own_photos()
    {
        $user1 = User::factory()->create();
        $this->post('/login', [
            'email' => $user1->email,
            'password' => 'password',
        ]);
        $photo = \App\Models\Photo::factory()->create();
        Auth::logout();

        $user2 = User::factory()->create();
        $this->post('/login', [
            'email' => $user2->email,
            'password' => 'password',
        ]);

        $response = $this->get('/photos/'.$photo->id);
        $response->assertDontSee($photo->title);
    }

    public function test_user_can_only_upload_to_own_albums()
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
        $response = $this->get('/photos/create'.$album->id);
        $response->assertDontSee('Upload new photo');
    }

    public function test_user_can_only_delete_own_photos()
    {
        $user1 = User::factory()->create();
        $this->post('/login', [
            'email' => $user1->email,
            'password' => 'password',
        ]);
        $photo = \App\Models\Photo::factory()->create();
        Auth::logout();

        $user2 = User::factory()->create();
        $this->post('/login', [
            'email' => $user2->email,
            'password' => 'password',
        ]);

        $this->delete('/photos/'.$photo->id);
        $response = $this->get('/albums');
        $response->assertDontSee('Photo deleted successfully');

    }
}
