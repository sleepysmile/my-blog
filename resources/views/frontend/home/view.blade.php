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
                    <img src="{{ $publication->getImagePath() }}"
                         srcset="{{ $publication->getImagePath() }} 2000w,
                                {{ $publication->getImagePath() }} 1000w,
                                {{ $publication->getImagePath() }} 500w" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
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

            <p class="entry__tags">
                <span>Post Tags</span>

                <span class="entry__tag-list">

                    @foreach($publication->tags as $tag)

                        <a href="{{ route('frontend.home.tag', ['slug' => $tag->slug]) }}">{{ $tag->name }}</a>

                    @endforeach

                </span>

            </p>
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


    <div class="comments-wrap">

        <div id="comments" class="column large-12">

            <h3 class="h2">5 Comments</h3>

            <!-- START commentlist -->
            <ol class="commentlist">

                <li class="depth-1 comment">

                    <div class="comment__avatar">
                        <img class="avatar" src="images/avatars/user-01.jpg" alt="" width="50" height="50">
                    </div>

                    <div class="comment__content">

                        <div class="comment__info">
                            <div class="comment__author">Itachi Uchiha</div>

                            <div class="comment__meta">
                                <div class="comment__time">April 30, 2019</div>
                                <div class="comment__reply">
                                    <a class="comment-reply-link" href="#0">Reply</a>
                                </div>
                            </div>
                        </div>

                        <div class="comment__text">
                            <p>Adhuc quaerendum est ne, vis ut harum tantas noluisse, id suas iisque mei. Nec te inani ponderum vulputate,
                                facilisi expetenda has et. Iudico dictas scriptorem an vim, ei alia mentitum est, ne has voluptua praesent.</p>
                        </div>

                    </div>

                </li> <!-- end comment level 1 -->

                <li class="thread-alt depth-1 comment">

                    <div class="comment__avatar">
                        <img class="avatar" src="images/avatars/user-04.jpg" alt="" width="50" height="50">
                    </div>

                    <div class="comment__content">

                        <div class="comment__info">
                            <div class="comment__author">John Doe</div>

                            <div class="comment__meta">
                                <div class="comment__time">April 30, 2019</div>
                                <div class="comment__reply">
                                    <a class="comment-reply-link" href="#0">Reply</a>
                                </div>
                            </div>
                        </div>

                        <div class="comment__text">
                            <p>Sumo euismod dissentiunt ne sit, ad eos iudico qualisque adversarium, tota falli et mei. Esse euismod
                                urbanitas ut sed, et duo scaevola pericula splendide. Primis veritus contentiones nec ad, nec et
                                tantas semper delicatissimi.</p>
                        </div>

                    </div>

                    <ul class="children">

                        <li class="depth-2 comment">

                            <div class="comment__avatar">
                                <img class="avatar" src="images/avatars/user-03.jpg" alt="" width="50" height="50">
                            </div>

                            <div class="comment__content">

                                <div class="comment__info">
                                    <div class="comment__author">Kakashi Hatake</div>

                                    <div class="comment__meta">
                                        <div class="comment__time">April 29, 2019</div>
                                        <div class="comment__reply">
                                            <a class="comment-reply-link" href="#0">Reply</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment__text">
                                    <p>Duis sed odio sit amet nibh vulputate
                                        cursus a sit amet mauris. Morbi accumsan ipsum velit. Duis sed odio sit amet nibh vulputate
                                        cursus a sit amet mauris</p>
                                </div>

                            </div>

                            <ul class="children">

                                <li class="depth-3 comment">

                                    <div class="comment__avatar">
                                        <img class="avatar" src="images/avatars/user-04.jpg" alt="" width="50" height="50">
                                    </div>

                                    <div class="comment__content">

                                        <div class="comment__info">
                                            <div class="comment__author">John Doe</div>

                                            <div class="comment__meta">
                                                <div class="comment__time">April 29, 2019</div>
                                                <div class="comment__reply">
                                                    <a class="comment-reply-link" href="#0">Reply</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="comment__text">
                                            <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est
                                                etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </li> <!-- end comment level 1 -->

                <li class="depth-1 comment">

                    <div class="comment__avatar">
                        <img class="avatar" src="images/avatars/user-02.jpg" alt="" width="50" height="50">
                    </div>

                    <div class="comment__content">

                        <div class="comment__info">
                            <div class="comment__author">Shikamaru Nara</div>

                            <div class="comment__meta">
                                <div class="comment__time">April 26, 2019</div>
                                <div class="comment__reply">
                                    <a class="comment-reply-link" href="#0">Reply</a>
                                </div>
                            </div>
                        </div>

                        <div class="comment__text">
                            <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.</p>
                        </div>

                    </div>

                </li>  <!-- end comment level 1 -->

            </ol>
            <!-- END commentlist -->

        </div> <!-- end comments -->

        <div class="column large-12 comment-respond">
            <div id="respond">
                <h3 class="h2">
                    Add Comment
                    <span>
                        Your email address will not be published
                    </span>
                </h3>
                <form class="js-commentForm" name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                    <fieldset>
                        @csrf
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
