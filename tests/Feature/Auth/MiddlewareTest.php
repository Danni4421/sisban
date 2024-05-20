<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_should_perform_verify_authenticate_middleware(): void
    {
        // asume we will to login as user with level rt and try to access authenticated route
        $this->post('/login', [
            'email' => 'bambang@gmail.com',
            'password' => 'bambang123',
        ])
            ->assertStatus(302)
            ->assertRedirect('/rt');

        $this->get('/rt/pengajuan/masuk')
            ->assertStatus(200)
            ->assertSeeText('Data Masuk');
    }

    public function test_should_validate_authentivated_user_level(): void
    {
        $this->post('/login', [
            'email' => 'bambang@gmail.com',
            'password' => 'bambang123',
        ])
            ->assertStatus(302)
            ->assertRedirect('/rt');

        $this->get('/rw')
            ->assertStatus(302)
            ->assertRedirect('/rt');

        $this->get('/rt/pengajuan/masuk')
            ->assertStatus(200);
    }

    public function test_should_redirect_back_if_the_authenticated_user_access_guest_route(): void
    {
        $this->post('/login', [
            'email' => 'bambang@gmail.com',
            'password' => 'bambang123',
        ])
            ->assertStatus(302)
            ->assertRedirect('/rt');

        $this->get('/login')
            ->assertStatus(302)
            ->assertRedirect('/rt');
    }
}
