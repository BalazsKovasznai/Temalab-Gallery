<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NewPhotoScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private User $user;
    private Album $album;
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

    public function test_user_can_see_the_page()
    {
        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user->id)->first()->id;

        $response = $this->actingAs($this->user)->get("/photos/create/".$albumid);
        $response->assertStatus(200);
        $response->assertSee('Upload new photo');
    }

    public function test_user_can_see_the_fields()
    {
        $albumid = DB::table('albums')->select('id')->where('user_id', $this->user->id)->first()->id;

        $response = $this->actingAs($this->user)->get("/photos/create/".$albumid);
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Title', 'Description', 'Photo']);


    }

}
