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

                @include('frontend.home._publication', [
                    'publication' => $publication
                ])

            @endforeach

        </div>

    </div>

    {{ $publications->links('frontend.layouts.pagination') }}

@stop
