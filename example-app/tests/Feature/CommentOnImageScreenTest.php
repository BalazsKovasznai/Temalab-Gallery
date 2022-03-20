<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentOnImageScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $album = \App\Models\Album::factory()->create();
        $photo = \App\Models\Photo::factory()->create();
        $response = $this->get('/photos/1');
        $response->assertSee('Comment');
    }
}
