<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Messages;

class HPluginWahaMessage
{
    /**
     * The content message.
     *
     * @var string|null
     */
    public $content;
    
    /**
     * The session.
     *
     * @var string|null
     */
    public $session;

    /**
     * The session.
     *
     * @var string|null
     */
    public $to;

    /**
     * The session.
     *
     * @var HPluginWahaLink|null
     */
    public $link;

    function content(string $content)
    {
        $this->content = $content;
        return $this;    
    }

    function session(string $session)
    {
        $this->session = $session;
        return $this;    
    }

    function to(string $to)
    {
        $this->to = $to;
        return $this;    
    }

    function link(HPluginWahaLink $link)
    {
        $this->link = $link;
        return $this;    
    }
}