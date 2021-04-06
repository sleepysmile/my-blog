<?php


namespace App\Managers;


use App\Models\Tags;
use Illuminate\Support\Facades\Cache;

class TagCacheManager extends BaseCacheManager
{
    public const SINGLETON_NAME = 'tagsCache';

    public static string $menuCache = 'menu_tags';

}
