<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Providers;

use Hubmais\HPluginWaha\Channels\HPluginWahaChannel;
use Hubmais\HPluginWaha\Services\Manager;
use Hubmais\HPluginWaha\Support\Client;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class HPluginWahaChannelServiceProvider extends ServiceProvider
{
     /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/h-waha.php', 'h-waha');

        $this->app->singleton(Client::class, function ($app) {
            $config = $app['config']['h-waha'];

            return new Client(
                $config['host'],
                intval($config['port']),
                $config['api_key'],
                @$config['timeout']?: intval($config['timeout']),
            );
        });

        $this->app->bind(Manager::class, function ($app) {
            return new Manager(
                $app->make(Client::class),
                $app['config']['h-waha.session'],
            );
        });

        $this->app->bind(HPluginWahaChannel::class, function ($app) {
            return new HPluginWahaChannel();
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('h-waha-channel', function ($app) {
                return $app->make(HPluginWahaChannel::class);
            });
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/h-waha.php' => $this->app->configPath('h-waha.php'),
            ], 'vonage');
        }
    }
}