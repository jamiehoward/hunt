<?php

namespace Tests\Browser\Auth;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();

    }

    public function testLoginPageCanBeAccessedFromHomepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#register')
                    ->assertPathIs('/register');
        });
    }

    public function testLoginPageCanBeAccessedFromLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->click('#register')
                    ->assertPathIs('/register');
        });
    }

    public function testFieldsAreRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Testing User')
                    ->type('email', 'testing1234@example.com')
                    ->type('password', 'test123')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/register');
        });
    }

    public function testUserCanRegisterAndBeLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Testing User')
                    ->type('email', 'testing1234@example.com')
                    ->type('password', 'test123')
                    ->type('#password-confirm', 'test123')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/campaigns');
        });
    }

    public function testUserCannotRegisterExistingEmail()
    {
        $email = 'testing1234@example.com';

        factory(User::class)->create([
            'email' => $email
            ]);

        $this->browse(function (Browser $browser) use ($email) {
            $browser->logout()
                    ->visit('/register')
                    ->type('name', 'Testing User')
                    ->type('email', $email)
                    ->type('password', 'test123')
                    ->type('#password-confirm', 'test123')
                    ->click('button[type="submit"]')
                    ->assertSee('already been taken')
                    ->assertPathIs('/register');
        }); 
    }
}
