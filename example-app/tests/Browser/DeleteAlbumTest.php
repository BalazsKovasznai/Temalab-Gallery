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
            $browser->loginAs(13);
            $album = \App\Models\Album::factory()->create();
            $browser->visit('/albums/create')
                ->type('name', '1')
                ->type('description', 'hello')
                ->press('Submit')
                ->assertPathIs('/home');
        });
    }
}
