<?php
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
}