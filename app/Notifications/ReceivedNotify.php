<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ReceivedNotify extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data=$data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {

        foreach($notifiable->devices as $key){
            push_notification($key->device_token,$this->data);
        }
        return [
            'title'=>$this->data['title'],
            'body'=>$this->data['body'],
            'type'=>$this->data['type'],
            'status'=>$this->data['status'],
            'data_id'=>$this->data['data_id'],
            'created_at'=>$this->data['created_at']
        ];
    }
}
