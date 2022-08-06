<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Lib\JWT\JWT;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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

        return $jwt->encode([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'is_admin' => false,
        ]);
    }

    public function logOut(): RedirectResponse
    {
        session()->forget('token');

        return redirect()->route('index');
    }

    public function auth($email, $password): ?User
    {
        $user = User::query()->where('email', $email)->first();
        if ($user instanceof User && $user->verify($password)) {
            return $user;
        }

        return null;
    }

    public function registerUser(RegisterRequest $request)
    {
        $name = $request->validated()['name'];
        $gender = $request->validated()['gender'];
        $date_of_birth = $request->validated()['date_of_birth'];
        $phone = $request->validated()['phone'];
        $email = $request->validated()['email'];
        $password = $request->validated()['password'];
        $image = $request->validated()['image'];

        try {
            DB::Transaction(function () use ($name, $gender, $date_of_birth, $phone, $email, $password, $image) {
                if (isset($image)) {
                    $image = saveImage($image)->id;
                }

                User::create([
                    'name' => $name,
                    'gender' => $gender,
                    'date_of_birth' => $date_of_birth,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => $password,
                    'role' => 0,
                ]);

                $user = $this->auth($email, $password);
                if ($user instanceof User) {
                    $token = $this->generateToken($user);
                    session()->put('token', $token);

                    return redirect()->route('app.index');
                }

                return redirect()->back();
            });
        } catch (\Exception $ex) {
            return redirect()->back()->with([
                'createError' => 'Không tạo được tài khoản',
            ]);
        }
    }
}