<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Tags
 * @package App\Models
 *
 * @property string $name
 * @property string $slug
 * @property boolean $popular
 */
class Tags extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'popular'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Tags $model) {
            $model->slug = Str::slug($model->name);
        });
        static::updated(function (Tags $model) {
            if ($model->slug === '') {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function publication()
    {
        return $this->belongsToMany(Publication::class,
            'publications_to_tags',
            'tag_id',
            'publication_id',
        );
    }

}
