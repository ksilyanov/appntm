<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use URL;

class UserLogin extends Mailable
{
    use Queueable, SerializesModels;

    private $textToken;
    private $expiresAt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textToken, $expiresAt)
    {
        $this->textToken = $textToken;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'User Login',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.temp-token',
            with: [
                'url' => URL::temporarySignedRoute('verify-login', $this->expiresAt, [
                    'token' => $this->textToken,
                ]),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
