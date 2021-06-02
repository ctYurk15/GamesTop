<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GamesTopPurchaseEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $email = "";
    private $keys = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $keys)
    {
        $this->email = $email;
        $this->keys = $keys;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.purchase')->to($this->email)->from('yurii.hrytsak.knm.2018@lpnu.ua')->with("keys", $this->keys);
    }
}
