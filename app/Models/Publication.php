<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
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
    use CrudTrait;
    use HasFactory;

    protected $table = 'publication';

    protected $fillable = [
        'title',
        'text',
        'published',
        'image',
    ];

    public function setImageAttribute($value)
    {
        $attributeName = 'image';
        $disk = 'public';
        $destination_path = 'publications';

        $this->uploadFileToDisk($value, $attributeName, $disk, $destination_path);

         return $this->attributes[$attributeName];
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class,
            'publications_to_tags',
            'publication_id',
            'tag_id'
        );
    }

}
