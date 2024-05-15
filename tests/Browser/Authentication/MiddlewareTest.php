<?php

namespace Tests\Browser\Authentication;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MiddlewareTest extends DuskTestCase
{
    /**
     * Try to access authenticated route without login session
     */
    public function test_unauthenticated_user_try_to_access_guarded_route_should_be_rejected(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/rt')
                    ->assertUrlIs('http://localhost:8000/login');
        });
    }

    /**
     * Try to access guest route while in auth
     */
    public function test_authenticated_user_try_to_access_guest_route_then_should_be_rejected(): void
    {
        $user = User::find(4);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(userId: $user)
                ->visit('/login')
                ->pause(500)
                ->assertUrlIs('http://localhost:8000/rw')
                ->logout();
        });
    }

    /**
     * Try to access different route level
     */
    public function test_authenticated_user_try_to_access_different_user_level_route_then_should_be_redirect_back(): void
    {
        $user = User::find(4);

        $this->browse(function (Browser $browser) use ($user) {
                $browser->loginAs(userId: $user)
                ->visit('/rt')
                ->pause(500)
                ->assertUrlIs('http://localhost:8000/rw')
                ->logout();
        });
    }
}
