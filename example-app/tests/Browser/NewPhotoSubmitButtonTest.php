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
            $user=\App\Models\User::factory()->create();
            $browser->loginAs($user->id)
                ->visit('/dashboard')
                ->clickLink('Create an Album')
                ->type('name', 'name')
                ->type('description', 'description')
                ->press('@Submit')
                ->press('@albumviewbutton')
                ->press('@uploadphotobutton')
                ->press('@Submit')
                ->assertSee('The title field is required.')
                ->assertSee('The description field is required.')
                ->assertSee('The photo field is required.')
            ;
        });
    }



    public function test_with_completely_filled()
    {
        $this->browse(function (Browser $browser) {

            $browser
                ->type('title', 'asd')
                ->type('description', 'asd')
                ->attach('photo', 'C:\Fotók\_GP_2672-kicsi.jpg')
                ->press('@Submit')
                ->assertSee('Photo created successfully!')
                ;
        });
    }

}
