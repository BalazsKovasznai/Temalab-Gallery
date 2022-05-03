<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    }

    public function test_user_can_only_get_own_shared_albums()
    {
        Auth::login($this->user1);
        $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'ulby'=>$this->user1->id,
            'user_id'=>$this->user1->id,
        ]);
        $this->post('/share', [
            'username' => $this->user2->name
        ]);

        Auth::logout();
        Auth::login($this->user3);

        $id = null;
        $shares = DB::table('user_album_sharing')->get();
        foreach ($shares as $share){
            if($share->album_id == $this->album->id && $share->user_id == $this->user2->id){
                $id = $share->id;
            }
        }
        $response = $this->get('/sharedwithme/{$id}');
        $response->assertDontSee($this->album->name);

    }

    public function test_user_can_only_get_own_shared_photos()
    {
        Auth::login($this->user1);
        $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'ulby'=>$this->user1->id,
            'user_id'=>$this->user1->id,
        ]);
        $this->post('/photos/create/$photo_id', [
            'title'=>$this->photo->name,
            'photo'=>$this->photo->image,
            'size'=>5,
            'description'=>$this->photo->name,
            'album_id'=>$this->album->id,

        ]);
        $this->post('/share', [
            'username' => $this->user2->name
        ]);

        Auth::logout();
        Auth::login($this->user3);

        $response = $this->get('/shared_photos/'.$this->photo->id);
        $response->assertDontSee($this->photo->title);
    }

    public function test_user_can_only_comment_own_shared_photos()
    {
        Auth::login($this->user1);
        $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'ulby'=>$this->user1->id,
            'user_id'=>$this->user1->id,
        ]);
        $this->post('/photos/create/$photo_id', [
            'title'=>$this->photo->name,
            'photo'=>$this->photo->image,
            'size'=>5,
            'description'=>$this->photo->name,
            'album_id'=>$this->album->id,

        ]);
        $this->post('/share', [
            'username' => $this->user2->name
        ]);

        Auth::logout();
        Auth::login($this->user3);

        $comment = "asd";
        $this->post('/comment_user', [
            'comment'=>$comment,
            'photo_id'=>$this->photo->id
        ]);

        $response = $this->get('/shared_photos/'.$this->photo->id);
        $response->assertDontSee($comment);
    }
}
