<?php

namespace App\Services\impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{

    function login(string $email, string $pass): bool
    {
       return Auth::attempt([
           'email' => $email,
           'password' => $pass
       ]);
    }
}
