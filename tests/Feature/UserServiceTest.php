<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        DB::delete('DELETE FROM users');
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $this->assertTrue($this->userService->login('asep@gmail.com', 'rahasia'));
    }

    public function testLoginFail()
    {
        $this->assertFalse($this->userService->login('user', 'password'));
    }
}
