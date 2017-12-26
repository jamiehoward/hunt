<?php

namespace Tests\Browser\Auth;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => 'test1234@example.org',
            'password' => bcrypt('test123')
            ]);
    }

    public function testLoginPageCanBeAccessedFromHomepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#login')
                    ->assertPathIs('/login');
        });
    }

    public function testLoginPageCanBeAccessedFromRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->click('#login')
                    ->assertPathIs('/login');
        });
    }

    public function testInvalidCredentialsAreRejected()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'bademail@example.org')
                    ->type('password', 'test123')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/login')
                    ->assertSee('do not match');
        });
    }

    public function testValidCredentialsAreAccepted()
    {
        $user = $this->user;

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'test123')
                    ->press('button[type="submit"]')
                    ->assertAuthenticatedAs($user);
        });
    }
}
