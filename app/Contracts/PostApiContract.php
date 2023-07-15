<?php

namespace App\Contracts;

use App\DTO\PostDTO;

interface PostApiContract
{
    public function getPosts(array $params): array;
    public function getSinglePost(int $id): ?array;
    public function createPost(array $data): array;
    public function updatePost(int $id, array $data): ?array;
    public function deletePost(int $id): ?array;
}
