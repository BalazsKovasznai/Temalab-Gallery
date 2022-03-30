<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewPhotoSubmitButtonTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_with_empty_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1);
            $album = \App\Models\Album::factory()->create();
            $browser->visit('/photos/create/1')
                    ->press('@Submit')
                ->assertPathIs('/photos/create/1');
        });
    }

    public function test_with_filled_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1);
            $browser->visit('/photos/create/1')
                ->type('title', 'asd')
                ->type('description', 'asd')
                ->press('@Submit')
                ->assertSee('The photo field is required');
        });
    }

    public function test_with_completely_filled()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1);
            $album = \App\Models\Album::factory()->create();
            $browser->visit('/photos/create/1')
                ->type('title', 'asd')
                ->type('description', 'asd')
                ->attach('photo', 'C:\Users\Ildiko\Desktop\virag.jpg')
                ->press('Submit')
                ->assertPathIs('/albums/1');
        });
    }

}
