<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewPhotoScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $album = \App\Models\Album::factory()->create();
        $response = $this->get('/photos/create/1');
        $response->assertStatus(200);
    }

    public function test_user_can_see_the_page()
    {
        $response = $this->get('/photos/create/1');
        $response->assertSee('Upload new photo');
    }

    public function test_user_can_see_the_fields()
    {
        $response = $this->get('/photos/create/1');
        $response->assertSee('Title');
        $response->assertSee('Description');
        $response->assertSee('Photo');
    }

}
