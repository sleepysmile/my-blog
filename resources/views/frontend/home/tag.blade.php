@php

/** @var \App\Models\Publication[] $publications */
/** @var \App\Models\Tags $tag */

@endphp

@extends('frontend.layouts.main')

@section('title', $tag->name)

@section('content')
    <div class="masonry-wrap">

        <div class="masonry">

            <div class="grid-sizer"></div>

            @foreach($publications as $publication)

                <article class="masonry__brick entry format-standard animate-this">

                    <div class="entry__thumb">
                        <a href="single-standard.html" class="entry__thumb-link">
                            <img src="images/thumbs/masonry/woodcraft-600.jpg"
                                 srcset="images/thumbs/masonry/woodcraft-600.jpg 1x, images/thumbs/masonry/woodcraft-1200.jpg 2x" alt="">
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
                                    <a href="single-standard.html">{{ $publication->getCreateDate() }}</a>
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

            @endforeach

        </div>

    </div>

    <div class="row">
        <div class="column large-full">
            <nav class="pgn">
                <ul>
                    <li><a class="pgn__prev" href="#0">Prev</a></li>
                    <li><a class="pgn__num" href="#0">1</a></li>
                    <li><span class="pgn__num current">2</span></li>
                    <li><a class="pgn__num" href="#0">3</a></li>
                    <li><a class="pgn__num" href="#0">4</a></li>
                    <li><a class="pgn__num" href="#0">5</a></li>
                    <li><span class="pgn__num dots">…</span></li>
                    <li><a class="pgn__num" href="#0">8</a></li>
                    <li><a class="pgn__next" href="#0">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
@stop
