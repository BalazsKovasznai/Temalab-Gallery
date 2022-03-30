<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use Tests\DuskTestCase;

class FolderButtonRedirectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(1)
                ->visit('/dashboard')
             ->clickLink('My Albums')
                ->assertPathIs('/albums');


        });

    }
}
