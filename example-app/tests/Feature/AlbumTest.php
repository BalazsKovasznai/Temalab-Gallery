<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
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
        $this->post('/albums/store', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'user_id'=>$this->user->id,
        ]);


    }


    public function test_user_can_see_new_album()
    {
        $response=$this->get('/albums');
        $response->assertStatus(200);
        $response->assertSee($this->album->name);
    }

   public function test_user_can_see_view()
    {

        $response = $this->actingAs($this->user)->get('/albums');
        $response->assertStatus(200);
        $response->assertSee('View');
    }

    public function test_user_can_see_upload_photo_link()
    {
        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user->id)->first()->id;
        $response = $this->actingAs($this->user)->get("/albums/".$albumid);
        $response->assertStatus(200);
        $response->assertSee('Upload Photo');
    }

    public function test_user_can_see_share()
    {
        $response = $this->actingAs($this->user)->get('/albums');
        $response->assertStatus(200);
        $response->assertSee('Share');
    }

    public function test_new_user_cant_see_no_albums_yet()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/albums');
        $response->assertStatus(200);
        $response->assertSee('No albums yet.');
    }


}
