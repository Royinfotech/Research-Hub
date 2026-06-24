<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResearchInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data)
    {
    }

    public function envelope(): Envelope
    {
        $email = $this->data['email'] ?? config('mail.from.address');
        $name = $this->data['name'] ?? config('mail.from.name');

        return new Envelope(
            from: new Address($email, $name),
            replyTo: [new Address($email, $name)],
            subject: 'New Research Hub inquiry from ' . ($this->data['name'] ?? 'a visitor'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry',
            with: ['data' => $this->data],
        );
    }

    public function build(): self
    {
        return $this->from($this->data['email'] ?? config('mail.from.address'), $this->data['name'] ?? config('mail.from.name'))
            ->replyTo($this->data['email'] ?? config('mail.from.address'), $this->data['name'] ?? config('mail.from.name'));
    }
}
