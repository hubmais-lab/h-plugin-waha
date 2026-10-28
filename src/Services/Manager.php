<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class Manager extends AbstractService
{
    function session(): SessionService
    {
        return new SessionService($this->client, $this->session);
    }

    function pairing(): PairingService
    {
        return new PairingService($this->client, $this->session);
    }

    function profile(): ProfileService
    {
        return new ProfileService($this->client, $this->session);
    }

    function contact(): ContactService
    {
        return new ContactService($this->client, $this->session);
    }

    function presence(): PresenceService
    {
        return new PresenceService($this->client, $this->session);
    }

    function chatting(): ChattingService
    {
        return new ChattingService($this->client, $this->session);
    }

    function chat(): ChatService
    {
        return new ChatService($this->client, $this->session);
    }

    function apiKey(): ApiKeyService
    {
        return new ApiKeyService($this->client, $this->session);
    }

    function group(): GroupService
    {
        return new GroupService($this->client, $this->session);
    }

    function call(): CallService
    {
        return new CallService($this->client, $this->session);
    }

    function event(): EventService
    {
        return new EventService($this->client, $this->session);
    }

    function media(): MediaService
    {
        return new MediaService($this->client, $this->session);
    }

    function observability(): ObservabilityService
    {
        return new ObservabilityService($this->client, $this->session);
    }
}