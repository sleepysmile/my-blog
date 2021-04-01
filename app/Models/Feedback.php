<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feedback
 * @package App\Models
 *
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $message
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Feedback extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $table = 'feedback';

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'email',
        'website',
        'message',
    ];

    /**
     * @param string $format
     * @return mixed
     */
    public function getCreateDate(string $format = 'M d, Y')
    {
        return $this->created_at->format($format);
    }

}
