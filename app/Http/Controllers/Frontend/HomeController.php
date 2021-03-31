<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Tags;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        $publications = Publication::query()
            ->select([
                'publication.*'
            ])
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
            ->where('slug', $slug)
            ->where('published', true)
            ->first();

        return view('frontend.home.view', [
            'publication' => $publication
        ]);
    }
}
