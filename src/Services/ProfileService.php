<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ProfileService extends AbstractService
{
    function show(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/profile");
    }

    function name(string $name, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/profile/name", compact('name'));
    }

    function status(string $status, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/profile/status", compact('status'));
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function picture(array $file, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/profile/picture", compact('file'));
    }

    function destroyPicture(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/profile/picture");
    }
}