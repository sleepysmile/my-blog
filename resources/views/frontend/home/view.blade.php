@php

    /** @var \App\Models\Publication $publication */

@endphp

@extends('frontend.layouts.main')

@section('title', $publication->title)

@section('content')

<main class="row content__page">

    <article class="column large-full entry format-standard">

        @if($publication->getImagePath() !== '')

            <div class="media-wrap entry__media">
                <div class="entry__post-thumb">
                    <img src="{{ $publication->getImagePath(\App\Models\Publication::DETAIL_SIZE_MEDIUM) }}"
                         srcset="{{ $publication->getImagePath(\App\Models\Publication::DETAIL_SIZE_LARGE) }} 2000w,
                                {{ $publication->getImagePath(\App\Models\Publication::DETAIL_SIZE_MEDIUM) }} 1000w,
                                {{ $publication->getImagePath(\App\Models\Publication::DETAIL_SIZE_SMALL) }} 500w" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
                </div>
            </div>

        @endif

        <div class="content__page-header entry__header">
            <h1 class="display-1 entry__title">
                {{ $publication->title }}
            </h1>
            <ul class="entry__header-meta">

                @if($publication->author)

                    <li class="author">
                        By
                        <p>{{ $publication->author->name }}</p>
                    </li>

                @endif


                <li class="date">
                    Date
                    <p>{{ $publication->getCreateDate() }}</p>
                </li>
            </ul>
        </div>

        <div class="entry__content">

            {!! $publication->text !!}


            @if($publication->tags()->exists())

                <p class="entry__tags">
                    <span>Post Tags</span>

                    <span class="entry__tag-list">

                        @foreach($publication->tags as $tag)

                            <a href="{{ route('frontend.home.tag', ['slug' => $tag->slug]) }}">{{ $tag->name }}</a>

                        @endforeach

                    </span>

                </p>

            @endif
        </div>

{{--    TODO        --}}
{{--        <div class="entry__pagenav">--}}
{{--            <div class="entry__nav">--}}
{{--                <div class="entry__prev">--}}
{{--                    <a href="#0" rel="prev">--}}
{{--                        <span>Previous Post</span>--}}
{{--                        Tips on Minimalist Design--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="entry__next">--}}
{{--                    <a href="#0" rel="next">--}}
{{--                        <span>Next Post</span>--}}
{{--                        Less Is More--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{-- TODO --}}
{{--        <div class="entry__related">--}}
{{--            <h3 class="h2">Related Articles</h3>--}}

{{--            <ul class="related">--}}
{{--                <li class="related__item">--}}
{{--                    <a href="single-standard.html" class="related__link">--}}
{{--                        <img src="images/thumbs/masonry/walk-600.jpg" alt="">--}}
{{--                    </a>--}}
{{--                    <h5 class="related__post-title">Using Repetition and Patterns in Photography.</h5>--}}
{{--                </li>--}}
{{--                <li class="related__item">--}}
{{--                    <a href="single-standard.html" class="related__link">--}}
{{--                        <img src="images/thumbs/masonry/dew-600.jpg" alt="">--}}
{{--                    </a>--}}
{{--                    <h5 class="related__post-title">Health Benefits Of Morning Dew.</h5>--}}
{{--                </li>--}}
{{--                <li class="related__item">--}}
{{--                    <a href="single-standard.html" class="related__link">--}}
{{--                        <img src="images/thumbs/masonry/rucksack-600.jpg" alt="">--}}
{{--                    </a>--}}
{{--                    <h5 class="related__post-title">The Art Of Visual Storytelling.</h5>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

    </article> <!-- end column large-full entry-->


    <div class="comments-wrap large-full">

        <div id="comments" class="column large-12">

            <h3 class="h2">{{ $publication->comments()->count() }} Comments</h3>

            <ol class="commentlist" id="commentAjaxContainer">

                @foreach($publication->comments as $comment)

                    @include('frontend.home._comment', [
                        'comment' => $comment
                    ])

                @endforeach

            </ol>

        </div>

        <div class="column large-12 comment-respond">
            <div id="respond">
                <h3 class="h2">
                    Add Comment
                    <span>
                        Your email address will not be published
                    </span>
                </h3>
                <form class="js-commentForm"
                      name="contactForm"
                      id="contactForm"
                      method="post"
                      action="{{ route('frontend.comment.create') }}"
                      autocomplete="off"
                      data-error-box=".js-errorBox"
                      data-ajax-container="#commentAjaxContainer"
                >
                    <div class="alert-box alert-box--error hideit js-errorBox" style="display: none">
                        <i class="fa fa-times alert-box__close" aria-hidden="true"></i>
                    </div>
                    <fieldset>
                        @csrf

                        <input class="js-parentInput" type="hidden" name="parent_id" value="">
                        <input type="hidden" name="owner_name" value="{{ \App\Models\Publication::class }}">
                        <input type="hidden" name="owner_id" value="{{ $publication->id }}">
                        <div class="form-field">
                            <input name="name" id="cName" class="full-width" placeholder="Your Name" value="" type="text">
                        </div>
                        <div class="form-field">
                            <input name="email" id="cEmail" class="full-width" placeholder="Your Email" value="" type="text">
                        </div>
                        <div class="form-field">
                            <input name="website" id="cWebsite" class="full-width" placeholder="Website" value="" type="text">
                        </div>
                        <div class="message form-field">
                            <textarea name="message" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                        </div>
                        <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Add Comment" type="submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>

@stop
