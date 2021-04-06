<?php

namespace App\Observers;

use App\Managers\PublicationCacheManager;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Class PublicationObserver
 * @package App\Observers
 *
 */
class PublicationObserver extends BaseObserver
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

        if ($this->isUser()) {
            $publication->created_by = $this->user->getAuthIdentifier();
            $publication->updated_by = $this->user->getAuthIdentifier();
        }
    }

    /**
     * @param Publication $publication
     */
    public function updating(Publication $publication)
    {
        if (empty($publication->slug)) {
            $publication->slug = Str::slug($publication->title);
        }

        if ($this->isUser()) {
            $publication->updated_by = $this->user->getAuthIdentifier();
        }
    }

}
