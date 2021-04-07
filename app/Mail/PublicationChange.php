<?php

namespace App\Mail;

use App\Models\Publication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PublicationChange extends Mailable
{
    use Queueable, SerializesModels;

    protected Publication $publication;

    /**
     * Create a new message instance.
     *
     * @param Publication $publication
     */
    public function __construct(Publication $publication)
    {
        $this->publication = $publication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('site.email.ost@yandex.ru')
            ->view('emails.publication.change')
            ->with([
                'publication' => $this->publication
            ]);
    }
}
