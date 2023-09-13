<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMailer extends Mailable
{
    

    use Queueable, SerializesModels;

    public $userInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $userInfo)
    {
        //
        $this->userInfo =$userInfo;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function build()
    {
        return $this->subject("To {$this->userInfo->name}")
        ->view('email.mail');
    }


    public function envelope()
    {
        return new Envelope(
            subject: 'User Mailer',
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
            view: 'view.name',
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
