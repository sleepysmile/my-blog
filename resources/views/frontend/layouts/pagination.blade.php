@php

/** @var \Illuminate\Pagination\Paginator $paginator */
/** @var array[] $elements */

@endphp

@if ($paginator->hasPages())
    <div class="row">
        <div class="column large-full">
            <nav class="pgn">
                <ul>
                    <li>
                        @if($paginator->onFirstPage())

                            <span class="pgn__prev">
                                Prev
                            </span>

                        @else

                            <a class="pgn__prev" href="{{ $paginator->previousPageUrl() }}" >
                                Prev
                            </a>

                        @endif

                    </li>

                    @foreach($elements as $element)

                        @if(is_string($element))


                            <li>
                                <span class="pgn__num dots">
                                    …
                                </span>
                            </li>

                        @endif

                            @if(is_array($element))

                                @foreach($element as $page => $url)

                                    @if($page === $paginator->currentPage())

                                        <li>
                                            <span class="pgn__num current">
                                                {{ $page }}
                                            </span>
                                        </li>

                                    @else

                                        <li>
                                            <a class="pgn__num" href="{{ $url }}">
                                                {{ $page }}
                                            </a>
                                        </li>

                                    @endif

                                @endforeach

                            @endif

                    @endforeach

                    <li>

                        @if($paginator->hasMorePages())

                            <a class="pgn__next" href="{{ $paginator->nextPageUrl() }}" >
                                Next
                            </a>

                        @else

                            <span class="pgn__next">
                                Next
                            </span>

                        @endif

                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif
