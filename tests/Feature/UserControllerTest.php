<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::delete('DELETE FROM users');
    }

    public function testLoginPage()
    {

        $this->get('/login')
            ->assertStatus(200)
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $this->post('/login', ['username' => 'asep@gmail.com', 'password' => 'rahasia'])
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
            ->assertRedirect('/login');
    }
}
