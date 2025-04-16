<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class StaffCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $password,)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }



    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Staff Credentials',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.staff_credentials',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
{
    return [
        Attachment::fromPath(public_path('asset-view/assets/png/logo_bangbara.png'))
            ->as('logo_bangbara.png')
            ->withMime('image/png'),
    ];
}

}