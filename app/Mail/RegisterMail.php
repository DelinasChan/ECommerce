<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $data ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        //
        $this->data = $data ;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $sender = config("mail.sender") ;
        return $this->from( $sender["mail"] , $sender["name"] )
                    ->view('emails.register')
                    ->with( $this->data );
    }
}
