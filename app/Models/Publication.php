<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
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
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property null|User $author
 * @property null|Tags[] $tags
 */
class Publication extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'publication';

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
        'title',
        'text',
        'published',
        'image',
    ];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class,
            'publications_to_tags',
            'publication_id',
            'tag_id'
        );
    }

    public function author()
    {
        return $this->belongsTo(User::class,
            'created_by',
            'id',
        );
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setImageAttribute($value)
    {
        $attributeName = 'image';
        $disk = 'public';
        $destination_path = 'publications';

        $this->uploadFileToDisk($value, $attributeName, $disk, $destination_path);

        return $this->attributes[$attributeName];
    }

    /**
     * @return string
     */
    public function getCuttingText(): string
    {
        return Str::limit($this->text, 200);
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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImagePath(): string
    {
        $disk = Storage::disk('public');
        if ($disk->exists($this->image)) {
            $disk->get($this->image);
        }

        return '';
    }

}
