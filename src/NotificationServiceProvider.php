<?php

namespace DouglasResende\FCM;

use DouglasResende\FCM\Channels\FirebaseChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

/**
 * Class NotificationServiceProvider
 * @package DouglasResende\FCM
 */
class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register
     */
    public function register()
    {
        $app = $this->app;
        $this->app->make(ChannelManager::class)->extend('fcm', function() use ($app) {
            return $app->make(FirebaseChannel::class);
        });
    }
}