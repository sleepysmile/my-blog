<?php

namespace App\Listeners;

use App\Mail\PublicationChange;
use App\Models\Publication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Publication $event
     * @return void
     */
    public function handle(Publication $event)
    {
        try {
            Mail::send(new PublicationChange($event));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }


}
