<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
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
            $user=\App\Models\User::factory()->create();
            $browser->loginAs($user->id)
                ->visit('/albums/create')
                ->press('@Submit')
                ->assertPathIs('/albums/create');
        });
    }

    public function test_with_filled_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/albums/create')
                ->type('name', 'asd')
                ->type('description', 'asd')
                ->press('@Submit')
                ->assertSee('Album created succesfully');
        });
    }

    public function test_with_completely_filled()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/albums/create')
                ->type('name', 'asd')
                ->type('description', 'asd')
                ->attach('cover-image', 'C:\Fotók\_GP_2672-kicsi.jpg')
                ->click('@Submit')
                ->assertSee('Album created succesfully');
        });
    }
}
