<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $volunteerName;
    public $oppTitle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status, $volunteerName, $oppTitle)
    {
        $this->status = $status;
        $this->volunteerName = $volunteerName;
        $this->oppTitle = $oppTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Registration Status')
                    ->view('emails.registration-status')
                    ->with([
                        'oppTitle' => $this->oppTitle,
                    ]);
    }
} 