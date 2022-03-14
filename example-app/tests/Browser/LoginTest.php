<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_home_login_button()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->press('loginButton')
            ->assertPathIs('/login');
        });
    }

}
