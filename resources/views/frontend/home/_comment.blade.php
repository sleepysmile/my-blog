@php

/** @var \App\Models\Comment $comment */

$isChildren = !$comment->children->isEmpty();

@endphp

<li class="comment {{ ($isChildren && $comment->parent_id === null) ? 'thread-alt' : '' }}">

    <div class="comment__avatar">
        <p style="width: 50px; height: 50px;"></p>
        {{--                            <img class="avatar" src="images/avatars/user-01.jpg" alt="" width="50" height="50">--}}
    </div>

    <div class="comment__content">

        <div class="comment__info">
            <div class="comment__author">{{ $comment->name }}</div>

            <div class="comment__meta">
                <div class="comment__time">{{ $comment->getCreateDate() }}</div>
                <div class="comment__reply">
                    <a class="comment-reply-link js-replyButton" data-id="{{ $comment->id }}" href="#0">Reply</a>
                </div>
            </div>
        </div>

        <div class="comment__text">
            <p>
                {{ $comment->message }}
            </p>
        </div>

    </div>

    @if($isChildren)

        <ul class="children">

            @foreach($comment->children as $child)

                @include('frontend.home._comment', [
                    'comment' => $child
                ])

            @endforeach

        </ul>

    @endif

</li>
