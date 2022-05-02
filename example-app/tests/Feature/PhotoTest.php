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
    public function test_user_can_create_photo_in_album()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);


        $album = \App\Models\Album::factory()->create();

        $response = $this->post('/albums/create', [
            'name'=>$album->name,
            'description'=>$album->description,
            'cover_image'=>$album->cover_image,
            'ulby'=>13,
            'user_id'=>$user->id,
        ]);

        $photo = \App\Models\Photo::factory()->create();
        $response = $this->post('/photos/create/$photo_id', [
            'title'=>$photo->name,
            'photo'=>$photo->image,
            'size'=>5,
            'description'=>$photo->name,
            'album_id'=>$album->id,

        ]);
        $response = $this->get('/albums/$album_id');
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
        Auth::login($user1);
        $album = \App\Models\Album::factory()->create();
        $this->post('/albums/create', [
            'name'=>$album->name,
            'description'=>$album->description,
            'cover_image'=>$album->cover_image,
            'ulby'=>$user1->id,
            'user_id'=>$user1->id,
        ]);
        Auth::logout();

        $user2 = User::factory()->create();
        Auth::login($user2);
        $response = $this->get('/photos/create'.$album->id);
        $response->assertSee('This content is currently unavailable.');
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

        $this->delete('/photos'.$photo->id);
        $response = $this->get('/albums');
        $response->assertDontSee('Photo deleted successfully');

    }
}
