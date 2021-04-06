<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Comment
 * @package App\Models
 *
 * @property integer $id
 * @property integer $owner_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $parent_id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $message
 * @property string $owner_name
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection $children
 */
class Comment extends Model
{
    use HasFactory;
    use QueryCacheable;

    /**
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'website',
        'message',
        'owner_name',
        'owner_id',
        'parent_id',
    ];

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            static::class,
            'parent_id',
            'id',
        );
    }

    /**
     * @param string $format
     * @return mixed
     */
    public function getCreateDate(string $format = 'M d, Y')
    {
        return $this->created_at->format($format);
    }

    /**
     * @return string
     */
    public function getUserAvatar(): string
    {
        return asset('assets/frontend/images/avatars/no-avatar.png');
    }

}
