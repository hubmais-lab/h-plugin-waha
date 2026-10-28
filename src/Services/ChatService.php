<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ChatService extends AbstractService
{
    function list(
        int $limit = 20,
        bool $merge = true,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/chats", compact('limit','merge','sortBy','sortOrder'));
    }

    function listOverview(
        int $limit = 20,
        bool $merge = true,
        ?int $offset = null,
        ?array $ids = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/chats/overview", compact('limit','merge','offset','ids'));
    }

    /**
     * @param array{merge:bool,limit:int,offset:int} $pagination
     * @param array{ids:list<string>} $filter
     */
    function storeOverview(
        array $pagination,
        array $filter,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/overview", compact('pagination','filter'));
    }

    function destroy(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/chats/{$chatId}");
    }

    function picture(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/chats/{$chatId}/picture");
    }

    /**
     * @param ?array{timestamp:array{gte:int,lte:int},fromMe:bool,ack:string} $filter
     */
    function listMessages(
        int $limit = 20,
        ?bool $merge = true,
        ?int $offset = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?bool $downloadMedia = null,
        ?array $downloadMediaMimetypes = null,
        ?array $filter = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/chats", array_merge(compact('limit','offset','merge','sortBy','sortOrder','downloadMedia','downloadMediaMimetypes'), [
            'filter.timestamp.gte' => $filter ? @$filter['timestamp']['gte'] : null,
            'filter.timestamp.lte' => $filter ? @$filter['timestamp']['lte'] : null,
            'filter.fromMe' => $filter ? @$filter['fromMe'] : null,
            'filter.ack' => $filter ? @$filter['ack'] : null,
        ]));
    }

    function destroyMessages(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/chats/{$chatId}/messages");
    }

    function readMessages(
        string $chatId,
        ?int $messages = null,
        ?int $days = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/messages", compact('messages','days'));
    }

    function showMessage(
        string $chatId,
        string $messageId,
        ?bool $merge = true,
        ?bool $downloadMedia = null,
        ?array $downloadMediaMimetypes = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/chats/{$chatId}/messages/{$messageId}", compact('merge','downloadMedia','downloadMediaMimetypes'));
    }

    function destroyMessage(
        string $chatId,
        string $messageId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/chats/{$chatId}/messages/{$messageId}");
    }

    function updateMessage(
        string $chatId,
        string $messageId,
        string $text,
        bool $linkPreview = true,
        bool $linkPreviewHighQuality = false,
        ?string $mentions = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/chats/{$chatId}/messages/{$messageId}", compact('text', 'linkPreview', 'linkPreviewHighQuality', 'mentions'));
    }

    function pinMessage(
        string $chatId,
        string $messageId,
        int $duration = 86400,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/messages/{$messageId}/pin", compact('duration'));
    }

    function unpinMessage(
        string $chatId,
        string $messageId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/messages/{$messageId}/unpin");
    }

    function archive(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/archive");
    }

    function unarchive(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/unarchive");
    }

    function unread(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/chats/{$chatId}/unread");
    }
}