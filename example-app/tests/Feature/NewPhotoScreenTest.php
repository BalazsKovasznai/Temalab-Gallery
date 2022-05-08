<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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
        $this->album = Album::factory()->create();
        Auth::login($this->user);
        $this->post('/albums/create', [
            'name'=>$this->album->name,
            'description'=>$this->album->description,
            'cover_image'=>$this->album->cover_image,
            'user_id'=>$this->user->id,
        ]);
    }

    public function test_user_can_see_the_page()
    {
        Auth::login($this->user);
        $response = $this->get('/photos/create'.$this->album->id);
        $response->assertSee('Upload new photo');
    }

    public function test_user_can_see_the_fields()
    {
        Auth::login($this->user);
        $response = $this->get('/photos/create'.$this->album->id);
        $response->assertSeeInOrder(['Title', 'Description', 'Photo']);
    }

}
