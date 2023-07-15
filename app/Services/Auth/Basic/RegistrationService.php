<?php

namespace App\Services\Auth\Basic;

use App\Contracts\Auth\RegistrationServiceContract;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;

class RegistrationService implements RegistrationServiceContract
{
    public function __construct(private UserRepository $userRepository){}

    public function register(array $data): User
    {
        return $this->userRepository->createUser($data);
    }
}
