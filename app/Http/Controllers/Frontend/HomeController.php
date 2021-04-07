<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Managers\BaseCacheManager;
use App\Managers\PublicationCacheManager;
use App\Managers\TagCacheManager;
use App\Models\Publication;
use App\Models\Tags;
use App\Singletons\SettingsManager;
use Illuminate\Http\Request;
use Rennokki\QueryCache\Query\Builder;

class HomeController extends Controller
{
    public SettingsManager $settings;

    public function __construct()
    {
        $this->settings = \app()->get(SettingsManager::SINGLETON_NAME);
    }

    public function index(Request $request)
    {
        $publications = Publication::query()
            ->select([
                'publication.*',
            ])
            ->with(['tags' => function ($query) {
                return $query
                    ->cacheFor(TagCacheManager::CACHE_TIME)
                    ->cacheTags(['tags:publication'])
                    ->limit(2);
            }])
            ->cacheFor(PublicationCacheManager::CACHE_TIME)
            ->cacheTags([PublicationCacheManager::$homeCache])
            ->orderBy('id', 'desc')
            ->published()
            ->paginate(12);

        return view('frontend.home.index', [
            'publications' => $publications
        ]);
    }

    public function tag(string $slug, Request $request)
    {
        $publications = Publication::query()
            ->select([
                'publication.*'
            ])
            ->leftJoin('publications_to_tags', 'publication.id', '=', 'publications_to_tags.publication_id')
            ->leftJoin('tags', 'publications_to_tags.tag_id', '=', 'tags.id')
            ->where('tags.slug', $slug)
            ->paginate(12);
        $tag = Tags::query()
            ->where('slug', $slug)
            ->first();

        return view('frontend.home.tag', [
            'publications' => $publications,
            'tag' => $tag,
        ]);
    }

    public function publicationView(string $slug)
    {
        $publication = Publication::query()
            ->cacheFor(PublicationCacheManager::CACHE_TIME)
            ->cacheTags([PublicationCacheManager::$viewCache . $slug])
            ->where('slug', $slug)
            ->where('published', true)
            ->with([
                'tags' => function ($query) {
                    return $query
                        ->cacheFor(TagCacheManager::CACHE_TIME)
                        ->cacheTags(['tags:publication'])
                        ->limit(2);
                },
                'comments' => function ($query) {
                    return $query
                        ->cacheFor(TagCacheManager::CACHE_TIME)
                        ->cacheTags(['comments:publication']);
                },
            ])
            ->firstOrFail();

        return view('frontend.home.view', [
            'publication' => $publication
        ]);
    }

    public function about()
    {
        return view('frontend.home.about', [
            'text' => $this->settings->get('about.text')
        ]);
    }

    public function contact()
    {
        return view('frontend.home.contact', [
            'text' => $this->settings->get('contact.text')
        ]);
    }

}
