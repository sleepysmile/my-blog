<?php

namespace App\Models;

use App\Interfaces\ImageContract;
use App\Managers\PublicationCacheManager;
use App\Managers\ResizeManager;
use App\Traits\CommentTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Publication
 * @package App\Models
 *
 * @property integer $id
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
 * @property null|Comment[] $comments
 */
class Publication extends Model implements ImageContract
{
    use CrudTrait;
    use HasFactory;
    use CommentTrait;
    use QueryCacheable;

    // CACHE CONFIGURE
    public $cacheFor = 3600 * 60;

    protected static $flushCacheOnUpdate = true;

    // IMAGE SIZES
    protected const SQUARE_SIZE = '200x200';

    protected const SMALL_SIZE = '120x100';

    protected const ORIGINAL_SIZE = 'original';

    protected ResizeManager $resizeManager;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->resizeManager = ResizeManager::instance()
            ->setModel($this)
            ->setStorage($this->getStorage())
            ->setImageManager(new ImageManager(['driver' => 'gd']))
            ->setPath('publication/');
    }

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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function setImageAttribute($value)
    {
        $file = request()->file('image');
        $path = $this->resizeManager
            ->save($file);

        return $this->attributes['image'] = $path;
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
        return $this->resizeManager->getPathByStorage($this->image);
    }

    public function sizes(): array
    {
        return [
            self::SQUARE_SIZE => [
                'width' => 200,
                'height' => 200
            ],
            self::SMALL_SIZE => [
                'width' => 120,
                'height' => 100
            ],
            '' => [
                'width' => false,
                'height' => false
            ]
        ];
    }

    public function uniqueDirName(): string
    {
        return 'publications/';
    }

    public function getStorage()
    {
        return Storage::disk('public');
    }
}
