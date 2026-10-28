<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Support;

use Hubmais\HPluginWaha\Exceptions\ClientException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    function __construct(
        protected string $host,
        protected int $port,
        protected string $apiKey,
        protected ?int $timeout = null
    )
    {
    }

    protected function client(): \GuzzleHttp\Client
    {
        $endpoint = rtrim($this->host, '/');

        if (empty($endpoint))
            throw new ClientException('HPluginWaha endpoint is not configured.', 400);

        $client = new \GuzzleHttp\Client([
            'base_uri' => "$endpoint:{$this->port}/",
            'timeout' => (int) $this->timeout?:30,
            'headers' => [
                'User-Agent' => 'HPluginWaha PHP 1.0',
                'Accept' => 'application/json',
                'X-Api-Key' => $this->apiKey
            ],
        ]);

        return $client;
    }

    public function get(string $uri, array $query = []): array
    {
        return $this->handleResponse(
            $this->client()->request('GET', ltrim($uri, '/'), ['query' => $query]),
            'GET',
            $uri,
            $query
        );
    }

    public function post(string $uri, array $payload = []): array
    {
        return $this->handleResponse(
            $this->client()->request('POST', ltrim($uri, '/'), ['json' => $payload]),
            'POST',
            $uri,
            $payload
        );
    }

    public function put(string $uri, array $payload = []): array
    {
        return $this->handleResponse(
            $this->client()->request('PUT', ltrim($uri, '/'), ['json' => $payload]),
            'PUT',
            $uri,
            $payload
        );
    }

    public function delete(string $uri, array $payload = []): array
    {
        return $this->handleResponse(
            $this->client()->request('DELETE', ltrim($uri, '/'), ['json' => $payload]),
            'DELETE',
            $uri,
            $payload
        );
    }

    public function options(string $uri, array $payload = []): array
    {
        return $this->handleResponse(
            $this->client()->request('OPTIONS', ltrim($uri, '/'), ['json' => $payload]),
            'OPTIONS',
            $uri,
            $payload
        );
    }

    public function requestRaw(string $method, string $uri, array $data = []): string
    {
        $method = strtoupper($method);

        return $this->handleResponse(
            $this->client()->request($method, ltrim($uri, '/'), [($method == 'GET' ? 'query' : 'json') => $data]),
            $method,
            $uri,
            $data,
            true
        );
    }

    protected function handleResponse(ResponseInterface $response, string $method, string $uri, array $data = [], bool $raw = false): array|string
    {
        if($response->getStatusCode() >= 200 && $response->getStatusCode() < 400)
            return $raw ? $response->getBody()->getContents() : (json_decode($response->getBody()->getContents(), true) ?: []);
        
        $context = [
            'method' => $method,
            'uri' => $uri,
            'request_data' => $data,
            'status' => $response->getStatusCode(),
            'response_body' => $response->getBody()->getContents(),
        ];

        throw new ClientException(
            'HPluginWaha request failed. Status: ' . $response->getStatusCode() . '. Response: ' . $response->getBody()->getContents(),
            $response->getStatusCode(),
            null,
            $context
        );
    }   
}