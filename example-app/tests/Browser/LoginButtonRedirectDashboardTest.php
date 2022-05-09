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


                $browser->logout(1)
                    ->visit('/login')
                    ->type('email','kovasznaibalazs@gmail.com')
                    ->type('password', '12345678')
                    ->press('@loginbutton')
                    ->assertPathIs('/dashboard');


            });
        }
    }
}

