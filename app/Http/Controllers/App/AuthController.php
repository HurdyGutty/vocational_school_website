<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Lib\JWT\JWT;
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
            $token = $this->generateToken($user);
            session()->put('token', $token);
            return redirect()->route('app.index');
        }
        return redirect()->back();
    }

    public function generateToken(User $user)
    {
        $jwt = c(JWT::class);
        $token = $jwt->encode([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'is_admin' => false
        ]);
        return $token;
    }

    public function logOut(): RedirectResponse
    {
        session()->forget('token');
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
