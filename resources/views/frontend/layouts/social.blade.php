@php

    /** @var \App\Singletons\SettingsManager $settings */
    $settings = app()->get(\App\Singletons\SettingsManager::SINGLETON_NAME)

@endphp

<ul class="header__social">

    @if($settings->get('fb.link') !== '')

        <li class="ss-facebook">
            <a href="{{ $settings->get('fb.link') }}">
                <span class="screen-reader-text">Facebook</span>
            </a>
        </li>

    @endif

    @if($settings->get('tw.link') !== '')

        <li class="ss-facebook">
            <a href="{{ $settings->get('tw.link') }}">
                <span class="screen-reader-text">Twitter</span>
            </a>
        </li>

    @endif

    @if($settings->get('bs.link') !== '')

        <li class="ss-facebook">
            <a href="{{ $settings->get('bs.link') }}">
                <span class="screen-reader-text">Dribbble</span>
            </a>
        </li>

    @endif

    @if($settings->get('pa.link') !== '')

        <li class="ss-facebook">
            <a href="{{ $settings->get('pa.link') }}">
                <span class="screen-reader-text">Behance</span>
            </a>
        </li>

    @endif

</ul>
