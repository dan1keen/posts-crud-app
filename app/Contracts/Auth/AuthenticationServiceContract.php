<?php

namespace App\Contracts\Auth;

interface AuthenticationServiceContract
{
    public function login(array $credentials): array;
    public function logout(): void;
}
