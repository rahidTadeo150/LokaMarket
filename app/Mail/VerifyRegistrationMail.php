<?php

namespace App\Mail;

use App\Models\pending_registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public pending_registration $pending;
    public string $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(
        pending_registration $pending,
        string $verificationUrl
    ) {
        $this->pending = $pending;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Email subject.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Email LokaMarket',
        );
    }

    /**
     * Email content.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.verify-registration',
        );
    }
}