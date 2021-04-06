<?php


namespace App\Managers;


class PublicationCacheManager extends BaseCacheManager
{
    public static string $homeCache = 'home_publications';

    public static string $viewCache = 'view_publications_';
}
