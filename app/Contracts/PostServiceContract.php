<?php

namespace App\Contracts;

use App\DTO\PostDTO;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostServiceContract
{
    public function getPosts(array $params): LengthAwarePaginator;

    /**
     * Данный метод создал для того чтобы выводить данные как из DummyJson, так и из локальной БД
     */
    public function getMergedPosts(array $params): LengthAwarePaginator;
    public function getPost(int $id): array;
    public function createPost(PostDTO $data): Post;
    public function updatePost(int $id, PostDTO $data): Post;
    public function deletePost(int $id): void;
}
