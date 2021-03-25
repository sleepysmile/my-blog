<?php

namespace App\Observers;

use App\Models\Tags;
use Illuminate\Support\Str;

class TagsObserver
{
    /**
     * Handle the Tags "created" event.
     *
     * @param  \App\Models\Tags  $tags
     * @return void
     */
    public function creating(Tags $tags)
    {
        $tags->slug = Str::slug($tags->name);
    }

    /**
     * @param Tags $publication
     */
    public function updating(Tags $tags)
    {
        if (empty($tags->slug)) {
            $tags->slug = Str::slug($tags->name);
        }
    }
}
