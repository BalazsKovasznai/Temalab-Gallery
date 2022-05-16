<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginButtonRedirectDashboardTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_see_dashboard()
    {
        {
            $this->browse(function ($browser) {
                $user = User::factory()->create([
                    'email' => 'test@laravel.com',
                ]);
                $browser->logout()->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('@loginbutton')
                    ->assertPathIs('/dashboard');

                $user->delete();
            });
        }
    }
}

