<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('user.login');
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $validatedData['username'];
        $pass = $validatedData['password'];

        if ($this->userService->login($user, $pass)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return redirect('/login')->with('error', 'Username atau password salah');
    }

    public function doLogout(Request $request) {
        $request->session()->forget('user');
        return redirect('/login');
    }
}
