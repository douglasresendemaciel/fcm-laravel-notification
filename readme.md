# Firebase Cloud Messaging library for laravel´s notifications

This library allow send push notifications to Firebase Cloud Messaging through laravel´s notifications. 

It´s possible send notifications to websites, Android and IOS without any other integration.

## Installation

Run the following command from you terminal:


 ```bash
 composer require "douglasresendemaciel/fcm-laravel-notification:@dev"
 ```

or add this to require section in your composer.json file:

 ```
 "douglasresendemaciel/fcm-laravel-notification"
 ```

then run ```composer update```

Once it is installed, you need to register the service provider. 
Open up config/app.php and add the following to the providers key.

```php
'providers' => [
...
DouglasResende\FCM\NotificationServiceProvider::class
...
```

## Usage

First, create your notification class using artisan ```php artisan make:notification MyNotification```

then implement the `\DouglasResende\FCM\Contracts\FirebaseNotification` contract in your notification class

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use DouglasResende\FCM\Contracts\FirebaseNotification;

class MyNotification extends Notification
{
    use Queueable;
```

then on ```public function via($notifiable)``` method return ```['fcm']```:

```php
...
public function via($notifiable)
{
    return ['fcm'];
}
...
```

And finally, open up config/services.php and add the Firebase api key:

```php
...
'fcm' => [
    'key' => 'API_KEY'
]
...
```

## References

For more information read the official documentation at [https://laravel.com/docs/5.3/notifications](https://laravel.com/docs/5.3/notifications)