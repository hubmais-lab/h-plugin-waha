<?php
namespace Hubmais\HPluginWaha\Channels;

use Hubmais\HPluginWaha\Client;
use Hubmais\HPluginWaha\Messages\HPluginWahaMessage;
use Illuminate\Notifications\Notification;

class HPluginWahaChannel
{
    function __construct(
        protected Client $client,
        protected ?string $session = null,
    )
    {

    }

    /**
     * Send the given notification.
     * 
     * @return array|null
     */
    public function send(mixed $notifiable, Notification $notification)
    {
        $message = $notification->toHWaha($notifiable);

        if (is_string($message))
            $message = new HPluginWahaMessage($message);

        $session = $message->session ?: $this->session;
        if(empty($session))
            $session = 'default';

        $to = $message->to;
        if(empty($to))
            $to = $notifiable->routeNotificationFor('h-waha', $notification);

        if(empty($to))
            return $to;

        $exists = $this->client->checkExists(
            $to,
            $session,
        );

        if($exists['numberExists'])
            return $this->client->sendText(
                $session,
                $exists['chatId'],
                trim($message->content),
            );
        
        return;
    }
}