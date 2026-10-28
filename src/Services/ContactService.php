<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ContactService extends AbstractService
{
    function list(
        int $limit = 20,
        ?int $offset = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/contacts/all", get_defined_vars());
    }

    function show(
        string $contactId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/contacts", get_defined_vars());
    }

    function about(
        string $contactId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/contacts/about", get_defined_vars());
    }
    
    function checkExists(
        string $phone,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();
        
        return $this->client->get("/api/contacts/check-exists", [
            'phone' => $phone,
            'session' => $session
        ]);
    }

    function profilePicure(
        string $contactId,
        ?bool $refresh = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/contacts/profile-picture", get_defined_vars());
    }

    function block(
        string $contactId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/contacts/block", get_defined_vars());
    }

    function unblock(
        string $contactId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/contacts/unblock", get_defined_vars());
    }

    function update(
        string $chatId,
        string $firstName,
        string $lastName,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/contacts/{$chatId}", compact('firstName','lastName'));
    }

    function lids(
        int $limit = 100,
        int $offset = 0,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/lids", compact('limit','offset'));
    }

    function lidsCount(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/lids/count");
    }

    function lidShow(
        string $lid,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/lids/{$lid}");
    }

    function lidPn(
        string $phoneNumber,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/lids/pn/{$phoneNumber}");
    }
}