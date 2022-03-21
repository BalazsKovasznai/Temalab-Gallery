<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateAlbumSubmitButtonRedirectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_with_empty_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/albums/create')
                ->press('Submit')
                ->assertPathIs('/albums/create');
        });
    }

    public function test_with_filled_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/albums/create')
                ->type('name', 'asd')
                ->type('description', 'asd')
                ->press('Submit')
                ->assertSee('The cover-image field is required.');
        });
    }

    public function test_with_completely_filled()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/albums/create')
                ->type('name', 'asd')
                ->type('description', 'asd')
                ->attach('cover-image', 'C:\Users\Ildiko\Desktop\virag.jpg')
                ->press('Submit')
                ->assertPathIs('/albums/store');
        });
    }
}
