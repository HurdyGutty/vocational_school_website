<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Lib\JWT\JWT;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('admin_auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $admin = $this->auth($data['email'], $data['password']);
        if ($admin instanceof Admin) {
            $token = $this->generateToken($admin);
            session()->put('token', $token);
            return redirect()->route('admin.index');
        }
        return redirect()->back();
    }

    public function generateToken(Admin $admin)
    {
        $jwt = c(JWT::class);
        $token = $jwt->encode([
            'id' => $admin->id,
            'name' => $admin->name,
            'role' => $admin->role,
            'is_admin' => true
        ]);
        return $token;
    }

    public function logOut(): RedirectResponse
    {
        session()->forget('token');
        return redirect()->route('index');
    }

    public function auth($email, $password): ?Admin
    {
        $admin = Admin::query()->where('email', $email)->first();
        if ($admin instanceof Admin && $admin->verify($password)) {
            return $admin;
        }
        return null;
    }
}
