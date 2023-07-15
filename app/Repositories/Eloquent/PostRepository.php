<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;

class PostRepository
{
    public function __construct(private Post $post){}

    /**
     * @param int|null $id
     * @param array $data
     * @return Post
     */
    public function updateOrCreatePost(?int $id, array $data): Post
    {
        return $this->post::updateOrCreate(['id' => $id], $data);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getPost(int $id): ?array
    {
        return $this->post::query()->find($id)?->toArray();
    }

    /**
     * @param int $maxId
     * @return array
     */
    public function getNonExistingPosts(int $maxId): array
    {
        return $this->post::query()->where('id', '>', $maxId)->get()->toArray();
    }

    /**
     * @param int $maxId
     * @return int
     */
    public function getNonExistingPostsCount(int $maxId): int
    {
        return $this->post::query()->where('id', '>', $maxId)->count();
    }

    public function deletePost(int $id): void
    {
        $this->post::query()->where(['id' => $id])->delete();
    }
}
