<?php

namespace App\Repositories\Api;

use App\Contracts\PostApiContract;
use App\Repositories\Api\Base\HttpClientRepository;

class DummyJsonApi extends HttpClientRepository implements PostApiContract
{
    public function __construct()
    {
        parent::__construct(config('services.dummy-json.host'));
    }

    /**
     * @throws \JsonException
     */
    public function getPosts(array $params): array
    {
        $response = $this->request('GET', "/posts", $params);

        if (! $response['success']) {
            throw new \Exception("DummyJson response exception with status {$response['status']}");
        }

        return $response['data'];
    }

    /**
     * @throws \JsonException
     */
    public function getSinglePost(int $id): ?array
    {
        $response = $this->request('GET', "/posts/$id");

        return $response['data'] ?? null;
    }

    /**
     * @throws \JsonException
     */
    public function updatePost(int $id, array $data): ?array
    {
        $response = $this->request('PUT', "/posts/$id", $data);

        return $response['data'] ?? null;
    }

    /**
     * @throws \JsonException
     */
    public function createPost(array $data): array
    {
        $response = $this->request('POST', "/posts/add", [...$data, 'userId' => auth()->id()]);

        return $response['data'];
    }

    /**
     * @throws \JsonException
     */
    public function deletePost(int $id): ?array
    {
        $response = $this->request('DELETE', "/posts/$id");

        return $response['data'] ?? null;
    }
}
