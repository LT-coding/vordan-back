<?php

namespace App\Mail\AdminManagement\Admin;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Created Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url = config('frontend.admin_management').'/login';

        return new Content(
            markdown: 'emails.adminManagement.admin.AdminCreateMail',
            with: [
                'name' => $this->data['name'],
                'username' => $this->data['username'],
                'password' => $this->data['password'],
                'url' => $url,
                'year' => Carbon::now()->format('y')
            ]
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
