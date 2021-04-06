<?php


namespace App\Managers;


use App\Models\Tags;
use Illuminate\Support\Facades\Cache;

class TagCacheManager extends BaseCacheManager
{
    public const SINGLETON_NAME = 'tagsCache';

    public static string $menuCache = 'menu_tags';

    /**
     * Формирование кеша тегов для меню
     *
     * @return mixed
     */
    public function getMenu()
    {
        return Cache::remember(self::$menuCache, self::CACHE_TIME, function () {
            return Tags::query()
                ->select([
                    'tags.name',
                    'tags.slug',
                    'publications_to_tags.tag_id',
                ])
                ->where('popular', true)
                ->leftJoin('publications_to_tags', 'tags.id', 'publications_to_tags.tag_id')
                ->whereNotNull('publications_to_tags.tag_id')
                ->limit(20)
                ->groupBy([
                    'publications_to_tags.tag_id'
                ])
                ->orderBy('tags.id', 'desc')
                ->get();
        });
    }


}
