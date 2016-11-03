<?php

namespace DouglasResende\FCM\Contracts;

use DouglasResende\FCM\Messages\FirebaseMessage;

/**
 * Interface FirebaseNotification
 * @package DouglasResende\FCM\Contracts
 */
interface FirebaseNotification
{
    /**
     * @param $notifiable
     * @param FirebaseMessage $message
     * @return mixed
     */
    public function toFCM($notifiable, FirebaseMessage $message);
}