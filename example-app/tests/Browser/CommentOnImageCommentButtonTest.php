<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CommentOnImageCommentButtonTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_not_leave_empty_comment()
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
                    ->type('title', 'title')
                    ->type('description', 'description')
                    ->attach('photo', 'C:\Fotók\_GP_2672-kicsi.jpg')
                    ->press('@Submit')
                    ->press('@photoview')
                    ->press('@Comment')
                    //->press('Comment')
                    ->assertSee("The comment field is required.");
        });
    }
    public function test_user_can_comment_own_photos()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->type('comment', 'comment asd')
                ->press('@Comment')
                ->assertSee('comment asd');
        });
    }
}
