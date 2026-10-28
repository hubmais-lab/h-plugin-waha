<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class CallService extends AbstractService
{
    function reject(
        string $from,
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/calls/reject", compact('from', 'id'));
    }
}