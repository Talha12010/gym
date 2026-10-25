<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mcgEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $sbj;

    /**
     * Create a new message instance.
     */
    public function __construct($msg, $subject)
    {
        $this->msg = $msg;
        $this->sbj = $subject; // This is the correct variable
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->sbj, // Use the correct property name
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password-reset', // Make sure your email blade is here
            with: ['msg' => $this->msg],    // Pass the link to the blade file
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
