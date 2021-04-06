<?php

namespace App\Models;

use App\Widgets\MenuItem;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Query\Builder;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Tags
 * @package App\Models
 *
 * @property string $name
 * @property string $slug
 * @property boolean $popular
 *
 * @method static Builder query()
 */
class Tags extends Model
{
    use CrudTrait;
    use HasFactory;
    use QueryCacheable;

    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'popular'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publications()
    {
        return $this->belongsToMany(Publication::class,
            'publications_to_tags',
            'tag_id',
            'publication_id',
        );
    }

    //SCOPES METHOD
    public function scopePopular($query)
    {
        return $query->where('popular', true);
    }

}
