<?php

namespace Tests\Browser;

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
        $this->browse(function ($browser) {
            $browser->loginAs(1)
                ->press('Log In')
                ->assertPathIs('/dashboard');


        });
    }
}

