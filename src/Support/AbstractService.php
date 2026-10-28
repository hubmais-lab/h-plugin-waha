<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Support;

abstract class AbstractService
{
    function __construct(
        protected Client $client,
        protected ?string $session = null,
    )
    {

    }

    function setSession(string $session)
    {
        $this->session = $session;
    }

    function getSession(): ?string
    {
        return $this->session;
    }
}