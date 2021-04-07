<?php

namespace App\Models;

use App\Interfaces\ImageContract;
use App\Managers\ResizeManager;
use App\Traits\ByUserIdScopeTrait;
use App\Traits\CommentTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Rennokki\QueryCache\Query\Builder;
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
 *
 * @method static Builder query()
 */
class Publication extends Model implements ImageContract
{
    use CrudTrait;
    use HasFactory;
    use CommentTrait;
    use QueryCacheable;
    use ByUserIdScopeTrait;

    // CACHE CONFIGURE
    public $cacheFor = 3600 * 60;

    protected static $flushCacheOnUpdate = true;

    // IMAGE SIZES
    public const MEDIUM_SIZE = '1200x1200';

    public const DETAIL_SIZE_SMALL = '500x500';

    public const DETAIL_SIZE_MEDIUM = '1000x1000';

    public const DETAIL_SIZE_LARGE = '2000x2000';

    public const SMALL_SIZE = '600x600';

    public const ORIGINAL_SIZE = '';

    protected ?ResizeManager $resizeManager = null;

    public function __construct(array $attributes = [])
    {
        $this->resizeManager = ResizeManager::instance()
            ->setModel($this)
            ->setStorage($this->getStorage())
            ->setImageManager(new ImageManager(['driver' => 'gd']))
            ->setPath('publication/');
        parent::__construct($attributes);
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

    public function author(): BelongsTo
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
     * @param string $size
     * @return string
     */
    public function getImagePath(string $size = ''): string
    {
        return $this->resizeManager->getPathByStorage($this->image, $size);
    }

    public function sizes(): array
    {
        return [
            self::MEDIUM_SIZE => [
                'width' => 1200,
                'height' => 1200
            ],
            self::SMALL_SIZE => [
                'width' => 600,
                'height' => 600
            ],
            self::DETAIL_SIZE_SMALL => [
                'width' => 500,
                'height' => 500
            ],
            self::DETAIL_SIZE_MEDIUM => [
                'width' => 1000,
                'height' => 1000
            ],
            self::DETAIL_SIZE_LARGE => [
                'width' => 2000,
                'height' => 2000
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

    // SCOPES METHODS
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

}
