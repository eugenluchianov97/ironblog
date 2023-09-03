<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($formData)
    {
        $this->mailData = $formData;
    }

    /**
     * Get the message envelope.
     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'Contact Us Mail',
//        );
//    }

//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }

//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }

    public function build(): ContactUsMail
    {
        $subject = $this->mailData['subject'];
        $replyToName = $this->mailData['name'];
        $replyTo = $this->mailData['email'];

        return $this->view('emails.contact-us')->cc($replyTo, $replyToName)->subject($subject)->replyTo($replyTo, $replyToName)->with(['data' => $this->mailData]);
    }
}
