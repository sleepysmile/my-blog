<?php


namespace App\Traits;


use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

trait CommentTrait
{
    /**
     * Связь с таблицей комментариев
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        /** @var $this Model */
        return $this->belongsToMany(
            Comment::class,
            $this->getTable(),
            'id',
            'id',
            null,
            'owner_id'
        )
            ->where('owner_name', static::class)
            ->whereNull('parent_id')
            ->orderBy('comment.id', 'desc');
    }
}
