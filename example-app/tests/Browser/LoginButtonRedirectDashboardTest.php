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
                $user=\App\Models\User::factory()->create();


                 $browser->loginAs($user->id)
                     ->visit('/dashboard')
                     ->assertSee("You're logged in!");



            });
        }
    }
}

