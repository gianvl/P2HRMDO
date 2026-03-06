<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VPACompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mrform;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mrform)
    {
        $this->mrform = $mrform;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $loginLink = url('/login');
        return $this->markdown('emails.vpa-completed')
                    ->with(['mrform' => $this->mrform, 'loginLink' => $loginLink])
                    ->subject('MR Form Completed - ' . $this->mrform->mrNum);
    }
}
