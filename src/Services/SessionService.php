<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class SessionService extends AbstractService
{
    function list()
    {
        return $this->client->get("/api/sessions");
    }

    function store(string $name = 'default', bool $start = true, ?array $config = null, ?array $apps = null)
    {
        return $this->client->post("/api/sessions", get_defined_vars());
    }

    function show(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}");
    }

    function update(string $name, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/sessions/{$session}", ['session' => $name]);
    }

    function destroy(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/sessions/{$session}");
    }

    function me(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/me");
    }

    function capping(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/capping");
    }

    function timelock(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/timelock");
    }

    function start(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/start");
    }

    function stop(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/stop");
    }

    function logout(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/sessions/{$session}/logout");
    }

    function restart(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();
        
        return $this->client->get("/api/sessions/{$session}/restart");
    }

    /**
     * @param array{webhooks:list<array{url:string,events:string}>} $config Ex. [{ "url": "https://sua-url-do-webhook.com", "events": ["message", "session.status"]} ]
     */
    function config(
        ?array $config,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();
        
        return $this->client->post("/api/sessions/default", compact('config'));
    }
}