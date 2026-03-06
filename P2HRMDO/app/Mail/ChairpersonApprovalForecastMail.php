<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChairpersonApprovalForecastMail extends Mailable
{
    use Queueable, SerializesModels;

    public $forecastSection1;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forecastSection1)
    {
        $this->forecastSection1 = $forecastSection1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $loginLink = url('/login');
        return $this->markdown('emails.chairperson-approval-forecast')
                    ->with(['forecastSection1' => $this->forecastSection1, 'loginLink' => $loginLink])
                    ->subject('Forecast Form Approved - ' . $this->forecastSection1->forecast_num_id);
    }
}
