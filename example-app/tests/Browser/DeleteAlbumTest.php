<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteAlbumTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $user=\App\Models\User::factory()->create();
            $browser->loginAs($user->id)
                ->visit('/dashboard')
                ->clickLink('Create an Album')
                ->type('name', 'albumtobedeleted')
                ->type('description', 'description')
                ->press('@Submit')
                ->press('@albumviewbutton')
                ->press('@deletealbumbutton')
                ->assertSee('Album deleted successfully')
                ->assertDontSee('albumtobedeleted')
            ;
        });
    }
}
