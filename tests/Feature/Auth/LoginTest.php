<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Should throw error when login with bad payload
     */
    public function test_should_throw_error_when_login_with_bad_payload(): void
    {
        $this->get('/login')
            ->assertStatus(200);

        // error response should say Email not found

        $this->post('/login', [
            'email' => 'notfound@mail.com',
        ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'Email tidak valid.',
                'password' => 'Wajib untuk mengisi Password.'
            ]);
    }

    /**
     * Should perform login process correctly
     */
    public function test_should_perform_login_correctly(): void
    {
        $this->get('/login')
            ->assertStatus(200);

        $this->post('/login', [
            'email' => 'pakteng@gmail.com',
            'password' => 'pakting12'
        ])
            ->assertStatus(302)
            ->assertRedirect('/rw');
    }
}
