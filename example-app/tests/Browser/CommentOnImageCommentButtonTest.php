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
            $browser
                    ->visit('/photos/1')
                    ->press('@Comment')
                    //->press('Comment')
                    ->assertSee("The comment field is required.");
        });
    }
    public function test_user_can_comment_own_photos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(13);
            $browser->visit('/photos/1')
                ->type('comment', 'comment asd')
                ->press('@Comment')
                ->assertSee('comment asd');
        });
    }
}
