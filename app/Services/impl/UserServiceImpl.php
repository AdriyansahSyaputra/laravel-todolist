<?php

namespace App\Services\impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        'admin' => 'password',
    ];

    function login(string $user, string $pass): bool
    {
        if (isset($this->users[$user]) && $this->users[$user] === $pass) {
            return true;
        }
        return false;
    }
}
