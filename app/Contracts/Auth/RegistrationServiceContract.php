<?php

namespace App\Contracts\Auth;

use App\Models\User;

interface RegistrationServiceContract
{
    public function register(array $data): User;
}
