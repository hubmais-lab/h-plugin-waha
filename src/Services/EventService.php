<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class EventService extends AbstractService
{
    /**
     * @param array{name:string,description:string,startTime:int,endTime:?int,location:array{name:string},extraGuestsAllowed:bool} $event
     */
    function send(
        string $chatId,
        array $event,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/events", compact('chatId', 'event', 'reply_to'));
    }
}