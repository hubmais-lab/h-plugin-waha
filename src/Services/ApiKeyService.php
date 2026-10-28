<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ApiKeyService extends AbstractService
{
    function list()
    {
        return $this->client->get("/api/keys");
    }

    /**
     * @param ?array{read:bool,send:bool,control:bool,setting:bool,app:bool,delete:bool} $actions
     */
    function store(
        bool $isAdmin = false,
        bool $isActive = true,
        ?array $actions = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/keys", get_defined_vars());
    }

    /**
     * @param ?array{read:bool,send:bool,control:bool,setting:bool,app:bool,delete:bool} $actions
     */
    function update(
        string $id,
        bool $isAdmin = false,
        bool $isActive = true,
        ?array $actions = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/keys/{$id}", get_defined_vars());
    }

    function media(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/keys/media");
    }

    function control(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/keys/control");
    }

    function destroy(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/keys/{$id}");
    }
}