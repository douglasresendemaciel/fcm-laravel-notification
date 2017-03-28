<?php

namespace DouglasResende\FCM\Channels;

use DouglasResende\FCM\Messages\FirebaseMessage;
use Illuminate\Contracts\Config\Repository as Config;
use GuzzleHttp\Client;
use DouglasResende\FCM\Contracts\FirebaseNotification as Notification;

/**
 * Class FirebaseChannel
 * @package DouglasResende\FCM\Channels
 */
class FirebaseChannel
{
    /**
     * @const api uri
     */
    const API_URI = 'https://fcm.googleapis.com/fcm/send';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Config
     */
    private $config;

    /**
     * FirebaseChannel constructor.
     * @param Client $client
     * @param Config $config
     */
    public function __construct(Client $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFCM($notifiable, new FirebaseMessage);

        $this->client->post(FirebaseChannel::API_URI, [
            'headers' => [
                'Authorization' => 'key=' . $this->getApiKey(),
                'Content-Type' => 'application/json',
            ],
            'body' => $message->serialize(),
        ]);
    }

    /**
     * @return mixed
     */
    private function getApiKey()
    {
        return $this->config->get('services.fcm.key');
    }
}