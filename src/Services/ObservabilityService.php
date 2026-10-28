<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ObservabilityService extends AbstractService
{
    function ping()
    {
        return $this->client->get("/ping");
    }

    function health()
    {
        return $this->client->get("/health");
    }

    function version()
    {
        return $this->client->get("/api/server/version");
    }

    function environment()
    {
        return $this->client->get("/api/server/environment");
    }

    function status()
    {
        return $this->client->get("/api/server/status");
    }

    function stop()
    {
        return $this->client->post("/api/server/stop");
    }

    function debugCpu(int $seconds = 30)
    {
        return $this->client->get("/api/server/debug/cpu", compact('seconds'));
    }

    function debugHeapsnapshot()
    {
        return $this->client->get("/api/server/debug/heapsnapshot");
    }

    function debugBrowserTrace(
        int $seconds = 30,
        array $categories = ['*'],
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/server/debug/browser/trace/{$session}", compact('seconds', 'categories'));
    }
}