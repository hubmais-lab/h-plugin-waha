<?php
namespace Hubmais\HPluginWaha\Facades;

use Hubmais\HPluginWaha\Client;
use Illuminate\Support\Facades\Facade;

class HPluginWaha extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}