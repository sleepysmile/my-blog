@php

/** @var \App\Models\Comment $comment */

$isChildren = !$comment->children->isEmpty();

@endphp

<li class="comment {{ ($isChildren && $comment->parent_id === null) ? 'thread-alt' : '' }}">

    <div class="comment__avatar">
        <img class="avatar" src="{{ $comment->getUserAvatar() }}" alt="" >
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
