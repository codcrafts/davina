<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrackOrder extends Mailable
{
    use Queueable, SerializesModels;

     protected $order;
    public function __construct($order)
    {
        $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
           $order=$this->order;
           $user=$order->user;

           return $this->to($user->email)
             ->view('mails.trackOrder',compact('order','user'));
    }
}
