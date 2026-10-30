<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Channels;

use Hubmais\HPluginWaha\Facades\HPluginWaha;
use Hubmais\HPluginWaha\Messages\HPluginWahaMessage;
use Illuminate\Notifications\Notification;

class HPluginWahaChannel
{
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

        $session = $message->session ?: HPluginWaha::getSession();
        if(empty($session))
            $session = 'default';

        $to = $message->to;
        if(empty($to))
            $to = $notifiable->routeNotificationFor('h-waha', $notification);

        if(empty($to))
            return $to;

        $exists = HPluginWaha::contact()->checkExists(
            $to,
            $session,
        );

        if($exists['numberExists'])
        {
            if($message->link)
                return HPluginWaha::chatting()->sendLinkCustomPreview(
                    $exists['chatId'],
                    trim($message->content),
                    [
                        'image' => ['url' => $message->link->image],
                        'url' => $message->link->url,
                        'title' => $message->link->title,
                        'description' => $message->link->title
                    ],
                    session: $session,
                );
            else
                return HPluginWaha::chatting()->sendText(
                    $exists['chatId'],
                    trim($message->content),
                    session: $session,
                );
        }
        
        return;
    }
}