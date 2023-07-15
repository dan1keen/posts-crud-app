<?php

namespace App\Services\Auth\Basic;

use App\Contracts\Auth\AuthenticationServiceContract;
use Illuminate\Support\Facades\Auth;

class AuthenticationService implements AuthenticationServiceContract
{

    public function login(array $credentials): array
    {
        $auth = Auth::attempt($credentials);

        return [
            'success' => $auth,
            'message' => $auth ? __('Успешно') : __('Неправильный логин или пароль')
        ];
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
