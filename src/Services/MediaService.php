<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class MediaService extends AbstractService
{
    function convertVoice(
        string $url,
        ?string $data = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/media/convert/voice", compact('url', 'data'));
    }

    function convertVideo(
        string $url,
        ?string $data = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/media/convert/video", compact('url', 'data'));
    }
}