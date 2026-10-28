<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class PresenceService extends AbstractService
{
    function show(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/presence");
    }

    function store(string $presence, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/presence", compact('presence'));
    }

    function showSubscribe(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/presence/{$chatId}");
    }

    function storeSubscribe(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/presence/{$chatId}/subscribe", compact('presence'));
    }
}