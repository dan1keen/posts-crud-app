<?php

namespace App\Services;

use App\Contracts\Post\EditPostActionContract;

class CrudPostService
{
    public function __construct(
        private readonly GetPostRepositoryContract $getPostRepository,
        private readonly EditPostActionContract    $editPostRepository,
    ){}
}
