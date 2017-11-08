<?php

namespace DouglasResende\FCM\Messages;

/**
 * Class FirebaseMessage
 * @package DouglasResende\FCM\Messages
 */
class FirebaseMessage
{
    /**
     * @var null
     */
    private $to = null;
    /**
     * @var null
     */
    private $notification = null;
    /**
     * @var null
     */
    private $data = null;

    /**
     * @param $topic
     * @return $this|null
     */
    public function toTopic($topic)
    {
        if (is_array($topic)) {
            return null;
        } else {
            $this->to = '/topics/' . $topic;
        }

        return $this;
    }

    /**
     * @param $title
     * @param $body
     * @return $this
     */
    public function setContent($title, $body)
    {
        $this->notification = compact('title', 'body');

        return $this;
    }

    /**
     * @param null $payload
     * @return $this
     */
    public function setMeta($payload = null)
    {
        $this->data = $payload;

        return $this;
    }
    
    /**
     * @param null $device_token
     * @return $this
     */
    public function setTo($device_token = null)
    {
        $this->to = $device_token;

        return $this;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $filtered = array_filter([
            'to' => $this->to,
            'notification' => $this->notification,
            'data' => $this->data,
        ]);

        return json_encode($filtered);
    }
}