<?php

namespace App\Repositories\Eloquent;

use App\Contracts\UserRepositoryContract;
use App\Models\User;

class UserRepository implements UserRepositoryContract
{
    public function __construct(private User $model){}

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->model::create($data);
    }
}
