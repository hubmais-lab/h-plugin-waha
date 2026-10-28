<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Facades;

use Hubmais\HPluginWaha\Services\Manager as HPluginWahaService;
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
        return HPluginWahaService::class;
    }
}