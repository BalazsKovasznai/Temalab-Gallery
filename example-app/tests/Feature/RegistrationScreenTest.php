<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/registration');

        $response->assertStatus(200);
    }

    public function test_user_register()
{
    $response = $this->post('/register', [
        'Username' => 'un',
        'Password' => 'pw',

    ]);
    $response->assertRedirect('/folders');
}
}
