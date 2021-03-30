<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Models
 *
 * @property integer $id
 * @property integer $owner_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $message
 * @property string $owner_name
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Comment extends Model
{
    use HasFactory;

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
    ];
}
