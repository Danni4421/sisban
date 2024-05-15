<?php

namespace Tests\Browser\Authentication;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * 
     * @group login
     */
    public function test_the_application_returns_expected_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Sistem Bantuan Sosial');
        });
    }

    /**
     * @group login
     */
    public function test_the_application_should_perform_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'pakteng@gmail.com')
                ->type('password', 'pakting12')
                ->press('Login')
                ->assertPathIs('/rw')
                ->logout();
        });
    }

    /**
     * @group login
     */
    public function test_should_response_error_if_given_invalid_request(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'invalidemail@notfound.error')
                ->type('password', 'xxx')
                ->press('Login')
                ->waitForText('Email tidak valid.')
                ->assertSee('Email tidak valid.')
                ->assertSee('Minimal password harus 8 karakter.');
        });
    }
}
