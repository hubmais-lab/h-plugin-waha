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

    function sendText(
        string $session,
        string $chatId,
        string $text
    )
    {
        return Http::withHeaders([
            'X-Api-Key' => $this->apiKey,
        ])->post("{$this->host}:{$this->port}/api/sendText", [
            'chatId' => $chatId,
            'text' => $text,
            'session' => $session
        ])
        ->json();;
    }
}