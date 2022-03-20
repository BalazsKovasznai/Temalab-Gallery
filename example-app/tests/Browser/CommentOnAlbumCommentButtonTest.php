<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CommentOnAlbumCommentButtonTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_not_leave_empty_comment()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1);
            $album = \App\Models\Album::factory()->create();
            $browser->visit('/albums/1')
                ->assertButtonDisabled('Comment');
        });
    }
    public function test_user_can_comment_own_photos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1);
            $album = \App\Models\Album::factory()->create();
            $browser->visit('/albums/1')
                ->type('comment', 'comment asd')
                ->press('Comment')
                ->assertSee('comment asd');
        });
    }
}
