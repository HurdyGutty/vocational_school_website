<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Lib\JWT\JWT;
use App\Mail\WelcomeMail;
use App\Models\User;
use ErrorException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $teacher_role = $request->validated()['teacher_role']??0;

        try {
            DB::Transaction(function () use ($name, $gender, $date_of_birth, $phone, $email, $password, $image,$teacher_role) {
                if (isset($image)) {
                    $image = saveImage($image)->id;
                }

                $user_created = User::create([
                    'name' => $name,
                    'gender' => $gender,
                    'date_of_birth' => $date_of_birth,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => $password,
                    'role' => $teacher_role,
                ]);
                
                Mail::to($email)->send(new WelcomeMail($teacher_role,$user_created->id));

                return redirect()->back()->with([
                    'createSuccess' => 'Tạo tài khoản thành công! Xin hãy xác nhận qua email',
                ]);

            });
        } catch (\Exception $ex) {
            return redirect()->back()->with([
                'createError' => 'Không tạo được tài khoản',
            ]);
        }
    }
    public function studentVerification(User $user_id = null)
    {
        try {
            DB::Transaction(function () use ($user_id) {
                if (!empty($user_id)) {
                    $user_id->update([
                        'active' => 1,
                    ]);
                    if ($user_id instanceof User) {
                        $token = $this->generateToken($user_id);
                        session()->put('token', $token);

                        return redirect()->route('app.index')->with([
                            'verified' => 'Xác minh thành công'
                        ]);
                    }
                } else {
                    throw new ErrorException('Xác minh thất bại');
                }
            });
        } catch (\Exception $ex) {
            return redirect()->route('index')->with([
                'unverified' => 'Xác minh thất bại'
            ]);;
        }
    }
}