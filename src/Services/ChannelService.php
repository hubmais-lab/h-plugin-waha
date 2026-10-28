<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ChannelService extends AbstractService
{
    function list(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels");
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $picture
     */
    function store(
        string $name, 
        string $description, 
        array $picture, 
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels", compact('name','description','picture'));
    }

    function show(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels/{$id}");
    }

    function destroy(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/channels/{$id}");
    }

    function preview(
        string $id, 
        int $limit = 10,
        bool $downloadMedia = false,
        ?array $downloadMediaMimetypes = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels/{$id}", compact('limit','downloadMedia', 'downloadMediaMimetypes'));
    }

    function follow(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/{$id}/follow");
    }

    function unfollow(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/{$id}/unfollow");
    }

    function mute(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/{$id}/mute");
    }

    function ummute(string $id, ?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/{$id}/ummute");
    }

    function searchByView(
        string $view, 
        string $startCursor = "",
        array $countries = [], 
        array $categories = [], 
        int $limit = 50, 
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/search/by-view", get_defined_vars());
    }

    function searchByText(
        string $text, 
        string $startCursor = "",
        array $categories = [], 
        int $limit = 50, 
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/channels/search/by-text", get_defined_vars());
    }

    function views(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels/search/views");
    }

    function countries(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels/search/countries");
    }

    function categories(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/channels/search/categories");
    }
}