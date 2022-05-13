<?php

namespace Tests\Feature;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;

class PhotoTest extends TestCase
{
    private $user;
    private $otheruser;
    private $album;
    private $albumid;
    private $photoid;
    private $photo;


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
        $this->albumid = DB::table('albums')->select('id')->where('user_id', $this->user->id)->first()->id;
        $this->photo = \App\Models\Photo::factory()->create();

        $file= UploadedFile::fake()->image('image.jpg');
        $this->post('/photos/store', [
            'title'=>$this->photo->title,
            'description'=>$this->photo->description,
            'photo'=> $file,
            'album-id' => $this->albumid
        ]);

        $this->photoid=DB::table('photos')->select('id')->where('album_id', $this->albumid)->first()->id;
        $this->otheruser = User::factory()->create();

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_photo_in_album()
    {
        $photo2 = \App\Models\Photo::factory()->create();

        $file= UploadedFile::fake()->image('image.jpg');
        $this->post('/photos/store', [
            'title'=>$photo2->title,
            'description'=>$photo2->description,
            'photo'=> $file,
            'album-id' => $this->albumid
        ]);

        $response = $this->get('/albums/'.$this->albumid);
        $response->assertStatus(200);
        $response->assertSee($photo2->title);

    }


    public function test_user_can_only_get_own_photos()
    {


        Auth::login($this->otheruser);
        $response = $this->get('/photos/'.$this->photoid);
        $response->assertStatus(200);

        $response->assertDontSee($this->photo->title);
    }

    public function test_user_can_only_upload_to_own_albums()
    {

        Auth::login($this->otheruser);
        $response = $this->get('/photos/create/'.$this->albumid);
        $response->assertStatus(302);

        $response->assertRedirect('/dashboard');
        $response= $this->get('/dashboard');
        $response->assertSee('Access denied');
    }

    public function test_user_can_only_delete_own_photos()
    {
        Auth::login($this->otheruser);
        $this->delete('/photos/'.$this->photoid);
        $response = $this->get('/albums');
        $response->assertStatus(200);
        $response->assertDontSee('Photo deleted successfully');

    }

    public function test_user_can_delete_own_photos()
    {
        Auth::login($this->user);
        $this->delete('/photos/'.$this->photoid);
        $response = $this->get('/albums');
        $response->assertStatus(200);
        $response->assertSee('Photo deleted successfully');

    }
}
