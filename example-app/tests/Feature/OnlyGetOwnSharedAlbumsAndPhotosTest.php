<?php

namespace Tests\Feature;

use Cassandra\Bigint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\Integer;
use Tests\TestCase;
use App\Models\User;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnlyGetOwnSharedAlbumsAndPhotosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private User $user1;
    private User $user2;
    private User $user3;
    private Album $album;
    private Photo $photo;


    public function setUp() :void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->user2 = User::factory()->create();
        $this->user3 = User::factory()->create();
        $this->album = Album::factory()->create();
        $this->photo = Photo::factory()->create();
        Auth::login($this->user1);
        $this->post('/albums/store', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'user_id'=>$this->user1->id,
        ]);
        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user1->id)->first()->id;

        $this->post('/share', [
            'username' => $this->user2->name,
            'album-id' => $albumid,
        ]);
    }

    public function test_user_can_only_get_own_shared_albums()
    {

        Auth::logout();
        Auth::login($this->user2);

        $response = $this->get("/sharedwithme");
        $response ->assertStatus(200);
        $response->assertSee($this->album->name);

    }

    public function test_user_can_only_get_own_shared_photos()
    {
        Auth::logout();
        Auth::login($this->user1);

        $file= UploadedFile::fake()->image('image.jpg');

        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user1->id)->first()->id;

        $this->post('/photos/store', [
            'title'=>$this->photo->title,
            'description'=>$this->photo->description,
            'photo'=> $file,
            'album-id' => $albumid
        ]);

        Auth::logout();
        Auth::login($this->user2);
        $photoid = DB::table('photos')->select('id')->where('album_id', $albumid)->first()->id;

        $response = $this->get('/shared_photos/'.$photoid);
        $response->assertSee($this->photo->title);
    }

    public function test_user_can_only_comment_own_shared_photos()
    {
        Auth::logout();
        Auth::login($this->user1);

        $file= UploadedFile::fake()->image('image.jpg');

        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user1->id)->first()->id;

        $this->post('/photos/store', [
            'title'=>$this->photo->title,
            'description'=>$this->photo->description,
            'photo'=> $file,
            'album-id' => $albumid
        ]);

        Auth::logout();
        Auth::login($this->user3);
        $photoid = DB::table('photos')->select('id')->where('album_id', $albumid)->first()->id;

        $comment = "asd";
        $this->post('/comment_user', [
            'comment'=>$comment,
            'photo_id'=>$photoid
        ]);

        Auth::logout();
        Auth::login($this->user2);
        $response = $this->get('/shared_photos/'.$photoid);
        $response->assertDontSee($comment);
    }
}
