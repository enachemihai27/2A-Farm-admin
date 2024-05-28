<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailableClass extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public $attachment;


    /**
     * Create a new message instance.
     */
    public function __construct($details, $attachment = null)
    {
        $this->details = $details;
        $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CV - Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.cv-job',
            with: ['details' => $this->details]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */

    public function attachments(): array
    {
        if ($this->attachment != null) {
            return [Attachment::fromPath($this->attachment)];
        }
        return [];
    }
}
