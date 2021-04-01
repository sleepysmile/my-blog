<ul class="header__nav">
    <li class="current"><a href="{{ route('frontend.home.index') }}" title="">Home</a></li>
    <li class="has-children">
        <a href="#0" title="">Tags</a>
        <ul class="sub-menu">
            @foreach($tags as $tag)

                <li>
                    <a href="{{ route('frontend.home.tag', ['slug' => $tag->slug]) }}">
                        {{ $tag->name }}
                    </a>
                </li>

            @endforeach
        </ul>
    </li>
    <li>
        <a href="{{ route('frontend.home.about') }}" title="">
            About
        </a>
    </li>
    <li>
        <a href="{{ route('frontend.home.contact') }}" title="">
            Contact
        </a>
    </li>
</ul>
