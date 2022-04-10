<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
