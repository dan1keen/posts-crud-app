<?php

namespace App\Services;

use App\Contracts\PostApiContract;
use App\Contracts\PostServiceContract;
use App\DTO\PostDTO;
use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PostService implements PostServiceContract
{
    public function __construct(
        private readonly PostApiContract $postApi,
        private readonly PostRepository  $postRepository,
    ){}

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function getPosts(array $params): LengthAwarePaginator
    {
        $page = $params['page'] ?? 1;
        $limit = Post::POST_SHOW_LIMIT;
        $skip = $limit * ($page - 1);

        $data = $this->postApi->getPosts([
            'limit' => $limit,
            'skip'  => $skip
        ]);

        return new LengthAwarePaginator(
            items: $data['posts'],
            total: $data['total'],
            perPage: $limit,
            currentPage: $page,
            options: ['path' => route('posts.index')]
        );
    }

    /**
     * Данный метод создал для того чтобы выводить данные как из DummyJson, так и из локальной БД
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function getMergedPosts(array $params): LengthAwarePaginator
    {
        $page = $params['page'] ?? 1;
        $limit = Post::POST_SHOW_LIMIT;
        $skip = $limit * ($page - 1);

        $data = $this->postApi->getPosts([
            'limit' => $limit,
            'skip'  => $skip
        ]);
        $maxId = $data['total'];

        if (ceil($data['total'] / $limit) < $page) {
            $posts = $this->postRepository->getNonExistingPosts($maxId);
            $data['posts'] = array_merge($data['posts'], $posts);
        }

        return new LengthAwarePaginator(
            items: Arr::map($data['posts'], fn($item) => [
                'id' => $item['id'],
                'title' => $item['title'] ?? 'Запись с локальной БД (Отсутствует заголовок)'
            ]),
            total: $data['total'] + $this->postRepository->getNonExistingPostsCount($maxId),
            perPage: $limit,
            currentPage: $page,
            options: ['path' => route('posts.index')]
        );

    }

    /**
     * @param int $id
     * @return array
     */
    public function getPost(int $id): array
    {
        $post = $this->postRepository->getPost($id);
        $postApi = $this->postApi->getSinglePost($id);

        $postData = new PostDTO(
            id: $post['id'] ?? $postApi['id'],
            title: $postApi['title'] ?? '',
            body: $postApi['body'] ?? '',
            authorName: $post['author_name'] ?? ''
        );

        return $postData->toArray();
    }

    /**
     * @param int $id
     * @param PostDTO $data
     * @return Post
     */
    public function updatePost(int $id, PostDTO $data): Post
    {
        $this->postApi->updatePost($id, $data->toApiArray());

        if ($deletedPost = Post::onlyTrashed()->find($id)) {
            $deletedPost->restore();
        }

        return $this->postRepository->updateOrCreatePost($id, ['author_name' => $data->authorName]);
    }

    /**
     * @param PostDTO $data
     * @return Post
     */
    public function createPost(PostDTO $data): Post
    {
        $post = $this->postApi->createPost($data->toApiArray());

        if ($deletedPost = Post::onlyTrashed()->find($post['id'])) {
            $deletedPost->restore();
        }

        return $this->postRepository->updateOrCreatePost($post['id'], ['author_name' => $data->authorName]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePost(int $id): void
    {
        $this->postApi->deletePost($id);

        $this->postRepository->deletePost($id);
    }
}
