<?php

namespace App\Observers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class PublicationObserver
 * @package App\Observers
 *
 * @property null|User $user
 */
class PublicationObserver
{
    /** @var User|null  */
    private ?User $user;

    public function __construct()
    {
        $user = Auth::guard('web')->user() !== null
            ? Auth::guard('web')->user()
            : Auth::guard('backpack')->user();
        $this->user = $user;
    }

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

    /**
     * @return bool
     */
    private function isUser()
    {
        return ($this->user !== null);
    }

}
