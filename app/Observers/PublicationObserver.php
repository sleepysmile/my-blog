<?php

namespace App\Observers;

use App\Models\Publication;
use Illuminate\Support\Str;

class PublicationObserver
{
    /**
     * Handle the Publication "created" event.
     *
     * @param  \App\Models\Publication  $publication
     * @return void
     */
    public function creating(Publication $publication)
    {
        $publication->slug = Str::slug($publication->title);
    }

    /**
     * @param Publication $publication
     */
    public function updating(Publication $publication)
    {
        if (empty($publication->slug)) {
            $publication->slug = Str::slug($publication->title);
        }
    }

}
