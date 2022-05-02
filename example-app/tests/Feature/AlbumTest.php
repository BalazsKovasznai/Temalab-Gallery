<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class  AlbumTest extends TestCase
{
    private $user;
    private $album;
    public function setUp() :void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post('/login', [
            'email' =>$this->user->email,
            'password' => 'password',
        ]);
        $this->album = \App\Models\Album::factory()->create();

    }

    public function test_user_can_see_new_album()
    {
        $response = $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'ulby'=>13,
            'user_id'=>$this->user->id,
        ]);
        $response->assertSee($this->album->name);
    }

   public function test_user_can_see_view()
    {
        $response = $this->get('/albums');
        $response = $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'ulby'=>13,
            'user_id'=>$this->user->id,
        ]);
        $response->assertSee('View');
    }

    public function test_user_can_see_upload_photo_link()
    {
        $response = $this->get('/albums/$album_id');
        $response->assertSee('Upload Photo');
    }

    public function test_user_can_see_share()
    {
        $response = $this->get('/albums/$album_id');
        $response->assertSee('Share');
    }

    public function test_new_user_can_see_no_albums_yet()
    {
        $response = $this->get('/albums');
        $response->assertSee('No albums yet.');
    }

}
