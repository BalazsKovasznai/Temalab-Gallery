<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShareButtonRedirectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_with_empty_username_field()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/albums/share/1')
                ->press('Share')
                ->assertPathIs('/albums/share/1')
                ->assertSee('Please enter a username');
        });
    }
    public function test_with_existing_username()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $browser->loginAs(1)
                ->visit('/albums/share/1')
                ->type('username', $user->username)
                ->press('Share')
                ->assertPathIs('/albums/share/store');
        });
    }
    public function test_with_nonexistent_username()
    {
        $this->browse(function (Browser $browser) {
            $username = $this->generateRandomString(12);
            while($this->usernameExist($username)){
                $username = $this->generateRandomString(12);
            }
            $browser->loginAs(1)
                ->visit('/albums/share/1')
                ->type('username', $username)
                ->press('Share')
                ->assertPathIs('/albums/share/1')
                ->assertSee("This username doesn't exist");
        });
    }
    private function usernameExist(String $username){
        $users = User::get();
        foreach($users as $user){
            if($user->name == $username){
                return true;
            }
        }
        return false;
    }
    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
