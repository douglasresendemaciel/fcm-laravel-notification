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

Implement your notification: 

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use DouglasResende\FCM\Messages\FirebaseMessage;

class MyNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['fcm'];
    }

    public function toFcm($notifiable) 
    {
       
        return (new FirebaseMessage())->setContent('Test Notification', 'This is a Test');
        
    }
}
```

Implement on your notifiable

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model {
    use Notifiable;

   public function routeNotificationForFcm() {
        //return a device token, either from the model or from some other place. 
        return $this->device_token;
    }

}
```


Open up config/broadcasting.php and add the Firebase api key to the connections section:

```php
...
'fcm' => [
    'key' => env('FCM_API_KEY','YOUR_API_KEY')
]
...
```

Trigger notification:
```php
$User = User::find(1);

//Send Notification
$User->notify(new MyNotification());
```

## References

For more information read the official documentation at [https://laravel.com/docs/5.3/notifications](https://laravel.com/docs/5.3/notifications)