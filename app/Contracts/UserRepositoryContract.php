<?php

namespace App\Contracts;

interface UserRepositoryContract
{
    public function createUser(array $data);
}
