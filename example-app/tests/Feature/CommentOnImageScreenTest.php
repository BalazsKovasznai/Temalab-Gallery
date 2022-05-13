<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentOnImageScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $user = User::factory()->create();
        $this->post('/login', [
            'email' =>$user->email,
            'password' => 'password',
        ]);
        $album = \App\Models\Album::factory()->create();
        $this->post('/albums/store', [
            'name'=>$album->name,
            'description'=>$album->description,
            'user_id'=>$user->id,
        ]);
        $photo = \App\Models\Photo::factory()->create();
        $file= UploadedFile::fake()->image('image.jpg');
        $albumid = DB::table('albums')->select('id')->where('user_id', $user->id)->first()->id;

        $this->post('/photos/store', [
            'title'=>$photo->title,
            'description'=>$photo->description,
            'photo'=> $file,
            'album-id' => $albumid
        ]);

        $photoid = DB::table('photos')->select('id')->where('album_id', $albumid)->first()->id;

        $response= $this->get("/photos/".$photoid);
        $response->assertStatus(200);
        $response->assertSee('Comment');


    }
}
