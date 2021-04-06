@php

    /** @var \App\Models\Publication $publication */

@endphp

<article class="masonry__brick entry format-standard animate-this">

    <div class="entry__thumb">
        <a href="{{ route('frontend.home.publication.view', ['slug' => $publication->slug]) }}" class="entry__thumb-link">

            @if($publication->getImagePath() !== '')

            <img src="{{ $publication->getImagePath() }}"
                 srcset="{{ $publication->getImagePath() }} 1x, {{ $publication->getImagePath() }} 2x" alt="">

            @endif
        </a>
    </div>

    <div class="entry__text">
        <div class="entry__header">
            <h2 class="entry__title">
                <a href="{{ route('frontend.home.publication.view', ['slug' => $publication->slug]) }}">
                    {{ $publication->title }}
                </a>
            </h2>
            <div class="entry__meta">
                <span class="entry__meta-cat">

                    @foreach($publication->tags()->limit(2)->get() as $tag)

                        <a href="{{ route('frontend.home.tag', ['slug' => $tag->slug]) }}">
                            {{ $tag->name }}
                        </a>

                    @endforeach

                </span>
                <span class="entry__meta-date">
                    <a href="{{ route('frontend.home.publication.view', ['slug' => $publication->slug]) }}">{{ $publication->getCreateDate() }}</a>
                </span>
            </div>
        </div>
        <div class="entry__excerpt">
            <p>
                {{ $publication->getCuttingText() }}
            </p>
        </div>
    </div>

</article>
