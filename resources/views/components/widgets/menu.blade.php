<ul class="header__nav">
    <li class="current"><a href="index.html" title="">Home</a></li>
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
    <li class="has-children">
        <a href="#0" title="">Blog Posts</a>
        <ul class="sub-menu">
            <li><a href="single-video.html">Video Post</a></li>
            <li><a href="single-audio.html">Audio Post</a></li>
            <li><a href="single-gallery.html">Gallery Post</a></li>
            <li><a href="single-standard.html">Standard Post</a></li>
        </ul>
    </li>
    <li><a href="styles.html" title="">Styles</a></li>
    <li><a href="page-about.html" title="">About</a></li>
    <li><a href="page-contact.html" title="">Contact</a></li>
</ul>
