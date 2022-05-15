<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_home_registration_button()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->press('@Register')
                ->assertPathIs('/register');
        });
    }

    public function test_user_can_registrate()
    {
        $this->browse(function (Browser $browser) {
            $browser->
                type('name','testuser')
                ->type('email','testuser@test.com')
                ->type('password','12345678')
                ->type('password_confirmation', '12345678')
                ->press('@breezeregisterbutton')
                ->assertSee("You're logged in!")


                ;
            DB::table('users')
                ->where('email','testuser@test.com')->delete();
        });
    }


}
