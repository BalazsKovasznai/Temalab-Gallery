<?php

namespace Tests\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
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
        $this->browse(function (Browser $browser) {
            $browser -> loginAs(1)
                ->visit('/dashboard')
                ->press('myalbums')
                ->assertPathIs('/myalbums');
        });

    }
}
