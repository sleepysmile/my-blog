<?php

namespace App\View\Components\Widgets;

use App\Models\Tags;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $tags = Tags::query()
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
            ->get();

        return view('components.widgets.menu', [
            'tags' => $tags
        ]);
    }
}
