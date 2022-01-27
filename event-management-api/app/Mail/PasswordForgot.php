<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordForgot extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mail_data;
    public function __construct($data)
    {
        //
        $this->mail_data   = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message =  $this->view('email.forgot-password')->subject($this->mail_data->subject);
        return $message;
        //return $this->view('view.name');
    }
}
