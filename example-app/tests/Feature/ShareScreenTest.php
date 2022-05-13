<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ShareScreenTest extends TestCase
{
    public function setUp() :void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->user2 = User::factory()->create();
        $this->album = Album::factory()->create();
        $this->photo = Photo::factory()->create();
        $this->post('/login', [
            'email' =>$this->user1->email,
            'password' => 'password',
        ]);
        $this->post('/albums/store', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'user_id'=>$this->user1->id,
        ]);

        $this->post('/share', [
            'username' => $this->user2->name,
            'album-id' => $this->album->id,
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_visit_share_form()
    {

        Auth::login($this->user1);
        $response = $this->get("/albums/".$this->album->id."/share");
        $response->assertStatus(200);
    }

    public function test_user_can_see_share_form()
    {
        Auth::login($this->user1);
        $response = $this->get("/albums/".$this->album->id."/share");
        $response->assertSeeText('Share an Album');
    }
}
