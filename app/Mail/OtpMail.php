<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $kode;

    public function __construct(string $kode)
    {
        $this->kode = $kode;
    }

    public function build()
    {
        return $this->subject('Kode OTP Verifikasi Akun Eventify')
            ->view('emails.otp');
    }
}
