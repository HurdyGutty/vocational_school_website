<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $admin = $this->auth($data['email'], $data['password']);
        if ($admin instanceof Admin) {
            session()->put('id', $admin->id);
            session()->put('name', $admin->name);
            session()->put('role', $admin->role);
            return redirect()->route('admin.index');
        }
        return redirect()->back();
    }

    public function logOut(): RedirectResponse
    {
        session()->flush();
        return redirect()->route('admin.auth.view_login');
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
