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
                ->visit('/albums/1/share/')
                ->press('Share')
                ->assertPathIs('/albums/1/share/')
                ->assertSee('Please enter a username');
        });
    }
    public function test_with_existing_username()
    {
        $this->browse(function (Browser $browser) {

            $browser->loginAs(1)
                ->visit('/albums/1/share/')
                ->type('username', 'balazs')
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
                ->visit('/albums/1/share/')
                ->type('username', $username)
                ->press('@Share')
                ->assertPathIs('/albums/1/share/')
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
