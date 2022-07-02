<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('landing_auth.login');
    }

    public function register(): View
    {
        return view('landing_auth.register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = $this->auth($data['email'], $data['password']);
        if ($user instanceof User) {
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('role', $user->role);
            return redirect()->route('app.index');
        }
        return redirect()->back();
    }

    public function logOut(): RedirectResponse
    {
        session()->flush();
        return redirect()->route('admin.auth.view_login');
    }

    public function auth($email, $password): ?User
    {
        $user = User::query()->where('email', $email)->first();
        if ($user instanceof User && $user->verify($password)) {
            return $user;
        }
        return null;
    }
}
