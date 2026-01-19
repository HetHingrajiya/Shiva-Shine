<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $subjectLine = "Your Checkout OTP")
    {
        $this->otp = $otp;
        $this->subjectLine = $subjectLine;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                    ]);
    }
}
