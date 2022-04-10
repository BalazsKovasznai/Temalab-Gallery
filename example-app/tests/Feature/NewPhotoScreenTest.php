<?php

namespace Tests\Feature;

use App\Models\User;
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
        $this->user = User::factory()->create();
        $this->post('/login', [
            'email' =>$this->user->email,
            'password' => 'password',
        ]);


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
        $response->assertSeeInOrder(['Title', 'Description', 'Photo']);
    }

}
