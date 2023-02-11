<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $user;
    protected $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $title, $id)
    {
        //
        $this->title = $title;
        $this->user = $user;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New post Added',
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
            markdown: 'emails.admin',
            with: [
                'url' => "http://localhost:8000/posts/".$this->id,
                'user' => $this->user,
                'title' => $this->title
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
