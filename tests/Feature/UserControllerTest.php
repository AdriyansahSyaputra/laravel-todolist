<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {

        $this->get('/login')
            ->assertStatus(200)
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {

        $this->post('/login', ['username' => 'admin', 'password' => 'password'])
            ->assertRedirect('/');
    }

    public function testLoginFailed()
    {

        $this->post('/login', ['username' => 'user', 'password' => 'password'])
            ->assertSessionHas('error', 'Username atau password salah')
            ->assertRedirect('/login');
    }

    public function testLogout()
    {
        $this->session(['user' => 'testuser']);

        $this->post('/logout')
            ->assertRedirect('/login');
    }

    public function testLogoutGuest() {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
