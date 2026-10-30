<?php
namespace Hubmais\HPluginWaha\Messages;

class HPluginWahaLink
{
    /**
     * The url image message.
     *
     * @var string|null
     */
    public $image;

    /**
     * The url message.
     *
     * @var string|null
     */
    public $url;

    /**
     * The title message.
     *
     * @var string|null
     */
    public $title;

    /**
     * The description message.
     *
     * @var string|null
     */
    public $description;

    function image(string $image)
    {
        $this->image = $image;
        return $this;    
    }

    function url(string $url)
    {
        $this->url = $url;
        return $this;    
    }

    function title(string $title)
    {
        $this->title = $title;
        return $this;    
    }

    function description(string $description)
    {
        $this->description = $description;
        return $this;    
    }
}