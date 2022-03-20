<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class  AlbumTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_see_new_album()
    {
        $album = \App\Models\Album::factory()->create();
        $response = $this->get('/albums');
        $response->assertSee($album->name);
    }

    public function test_user_can_see_view()
    {
        $response = $this->get('/albums');
        $response->assertSee('View');
    }

    public function test_user_can_see_upload_photo_link()
    {
        $response = $this->get('/albums/1');
        $response->assertSee('Upload Photo');
    }


}
