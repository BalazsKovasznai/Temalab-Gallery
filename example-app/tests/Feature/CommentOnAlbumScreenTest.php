<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentOnAlbumScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $album = \App\Models\Album::factory()->create();
        $response = $this->get('/albums/1');
        $response->assertSee('Comment');
    }
}
