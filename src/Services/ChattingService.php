<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class ChattingService extends AbstractService
{
    function sendText(
        string $chatId,
        string $text,
        bool $linkPreview = true,
        bool $linkPreviewHighQuality = false,
        ?string $id = null,
        ?string $mentions = null,
        ?string $reply_to = null,        
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendText", get_defined_vars());
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function sendImage(
        string $chatId,
        array $file,
        string $caption,
        ?string $mentions = null,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendImage", get_defined_vars());
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function sendFile(
        string $chatId,
        array $file,
        string $caption,
        ?string $mentions = null,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendFile", get_defined_vars());
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function sendVoice(
        string $chatId,
        array $file,
        bool $convert = true,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendVoice", get_defined_vars());
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function sendVideo(
        string $chatId,
        array $file,
        string $caption,
        bool $convert = true,
        bool $asNote = false,
        ?string $mentions = null,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendVideo", get_defined_vars());
    }

    /**
     * @param array{url:string} $file
     */
    function sendStiker(
        string $chatId,
        array $file,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendStiker", get_defined_vars());
    }

    /**
     * @param array{image:array{url:string},url:string,title:string,description:string} $preview
     */
    function sendLinkCustomPreview(
        string $chatId,
        string $text,
        array $preview,
        bool $linkPreviewHighQuality = true,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/send/link-custom-preview", get_defined_vars());
    }

    /**
     * @param array{title:string,description:string,footer:string,button:string,sections:list<array{title:string,rows:list<array{title:string,rowId:string,description:?string}>}>} $message
     */
    function sendList(
        string $chatId,
        array $message,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendList", get_defined_vars());
    }

    function forwardMessage(
        string $chatId,
        string $messageId,
        ?string $id = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/forwardMessage", get_defined_vars());
    }

    function sendSeen(
        string $chatId,
        array $messageIds,
        ?string $participant = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendSeen", get_defined_vars());
    }

    function startTyping(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/startTyping", get_defined_vars());
    }

    function stopTyping(
        string $chatId,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/stopTyping", get_defined_vars());
    }

    function reaction(
        string $chatId,
        string $reaction,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->put("/api/reaction", get_defined_vars());
    }

    function star(
        string $chatId,
        string $messageId,
        bool $star = true,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->put("/api/star", get_defined_vars());
    }

    /**
     * @param array{name:string,options:list<string>,multipleAnswers:bool} $poll
     */
    function sendPoll(
        string $chatId,
        array $poll,
        ?string $reply_to = null,
        ?string $id = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendPoll", get_defined_vars());
    }

    function sendPollVote(
        string $chatId,
        string $pollMessageId,
        array $votes,
        ?string $pollServerId = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendPollVote", get_defined_vars());
    }

    function sendLocation(
        string $chatId,
        string $title,
        float $latitude,
        float $longitude,
        ?string $id = null,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendLocation", get_defined_vars());
    }

    /**
     * @param list<array{fullName:string,organization:string,phoneNumber:string,whatsappId:string,vcard:?string}> $contacts
     */
    function sendContactVcard(
        string $chatId,
        string $title,
        array $contacts,
        ?string $id = null,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/sendContactVcard", get_defined_vars());
    }

    function sendButtonsReply(
        string $chatId,
        string $selectedButtonID,
        string $selectedDisplayText,
        ?string $reply_to = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client
        ->post("/api/send/buttons/replay", get_defined_vars());
    }

    function newMessageId(?string $session = null)
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/new-message-id");
    }
}