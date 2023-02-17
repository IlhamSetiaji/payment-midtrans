<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var \App\Services\User\UserService
     */
    private $userService;

    public function __construct(\App\Services\User\UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('Users.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $payload = $request->validated();
        $user = $this->userService->login($payload);
        if ($user) {
            return redirect()->route('home');
        }
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::logout(request()->user());
        return redirect()->route('login');
    }

    public function home()
    {
        return view('Users.home');
    }
}
