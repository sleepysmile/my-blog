<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationToTags extends Model
{
    use HasFactory;

    protected $table = 'publications_to_tags';

    protected $fillable = [
        'publication_id',
        'tag_id'
    ];
}
