<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShareButtonRedirectTest extends DuskTestCase
{
    private $user1;
    private $user2;
    public function setUp() :void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->user2 = User::factory()->create();



    }
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_with_empty_username_field()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user2->id)
                ->logout($this->user2)
                ->loginAs($this->user1->id)
                ->visit('/dashboard')
                ->clickLink('Create an Album')
                ->type('name', 'name')
                ->type('description', 'description')
                ->press('@Submit')
                ->press('@albumindexsharebutton')
                ->assertSee('User to share');
        });
    }
    public function test_with_nonexistent_username()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->type('username', 'nonexistentuser')
                ->press('@Share')
                ->assertSee('The selected username is invalid');
        });
    }
    public function test_with_existing_username()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->type('username', $this->user2->name)
                ->press('@Share')
                ->assertSee('Sharing created successfully!');
        });
    }


}
