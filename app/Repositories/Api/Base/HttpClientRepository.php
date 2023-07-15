<?php

namespace App\Repositories\Api\Base;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class HttpClientRepository
{
    protected PendingRequest $client;

    public function __construct(string $baseUrl)
    {
        $this->client = Http::baseUrl($baseUrl)->withoutVerifying();
    }

    /**
     * @throws \JsonException
     * @throws \Exception
     */
    protected function request(string $method, string $uri, array $params = [])
    {
        $method = strtolower($method);

        $response = $this->client->$method($uri, $params);

        return $this->parseResponse($response);
    }

    /**
     * @param Response $response
     * @param bool $raw
     * @return mixed
     * @throws \JsonException
     */
    private function parseResponse(Response $response, bool $raw = false): mixed
    {
        $body = $response->json() ?? $response->body();
        $body = is_string($body) ?
            json_decode($body, true, 512, JSON_THROW_ON_ERROR) :
            $body;

        if ($raw) {
            $result = $body;
        } else {
            $result['success'] = $body['success'] ?? $response->successful();
            $result['data']    = $result['success'] ? $body : [];
            $result['errors']  = !$result['success'] ? (!empty($body['errors']) ? $body['errors'] : ($body['message'] ?? $body)) : [];
            $result['status']  = $response->status();
        }

        return $result;
    }

}
