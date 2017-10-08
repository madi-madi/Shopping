<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mymail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoices)
    {
        return $this->view('mail.mesgmail', compact('invoices'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
    }
}
