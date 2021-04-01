@extends('frontend.layouts.main')

@section('title', 'My blog main page')

@section('content')

<main class="row content__page">

    <section class="column large-full entry format-standard">

        {!! $text !!}

    </section>

</main>

@stop
