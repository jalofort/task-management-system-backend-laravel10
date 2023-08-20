<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthService
{
    public function login($email, $password)
    {
        $user = User::select(
            DB::raw("CONCAT(first_name, ' ', last_name) as full_name"),
            'password',
            'access_token'
        )
            ->where('email', $email)
            ->first();

        if (!$user)
            return response(['message' => 'Login failed!'], 401);

        if (!password_verify($password, $user['password']))
            return response(['message' => 'Login failed!'], 401);

        return [
            'message' => 'You have successfully logged in',
            'user' => [
                'fullName' => $user['full_name'],
                'accessToken' => $user['access_token'],
            ]
        ];
    }

    public function register($firstName, $lastName, $email, $password)
    {
        $user = User::create([
            'first_name' => ucfirst(strtolower($firstName)),
            'last_name' => ucfirst(strtolower($lastName)),
            'email' => strtolower($email),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'access_token' => Str::random(60),
            'created_at' => time(),
        ]);

        if ($user)
            return response(['message' => 'You have successfully registered'], 201);

        return response(['message' => 'Internal server error'], 500);
    }
}
