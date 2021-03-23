<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Publication
 * @package App\Models
 *
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $image
 * @property boolean $published
 */
class Publication extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'publication';

    protected $fillable = [
        'title',
        'text',
        'published',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Publication $model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function setImageAttribute($value)
    {
        $attributeName = 'image';
        $disk = 'public';
        $destination_path = 'publications';

        $this->uploadFileToDisk($value, $attributeName, $disk, $destination_path);

         return $this->attributes[$attributeName];
    }

}