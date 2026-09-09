<?php
namespace Hubmais\HPluginWaha;

use Illuminate\Support\Facades\Http;

class Client
{
    function __construct(
        protected string $host,
        protected int $port,
        protected string $apiKey,
    )
    {
    }

    private function request()
    {
        return Http::baseUrl("{$this->host}:{$this->port}/api")
        ->withHeaders([
            'X-Api-Key' => $this->apiKey,
        ]);
    }

    function checkExists(
        string $phone,
        string $session
    )
    {
        return $this->request()
        ->post("/contacts/check-exists", [
            'phone' => $phone,
            'session' => $session
        ])
        ->json();
    }

    function sendText(
        string $session,
        string $chatId,
        string $text
    )
    {
        return $this->request()
        ->post("/sendText", [
            'chatId' => $chatId,
            'text' => $text,
            'session' => $session
        ])
        ->json();
    }
}