@php

@endphp


{!!
    \App\Widgets\Menu::instance()
        ->setIsActiveRequest(true)
        ->setWrapTemplate('<ul class="header__nav">{items}</ul>')
        ->setActiveClass('current')
        ->add(new \App\Widgets\MenuItem('Home', 'frontend.home.index'))
        ->add(new \App\Widgets\MenuItem('Categories', '#0', [
            new \App\Widgets\MenuItem('Lifestyle', '#'),
            new \App\Widgets\MenuItem('Health', '#'),
            new \App\Widgets\MenuItem('Family', '#'),
            new \App\Widgets\MenuItem('Management', '#'),
            new \App\Widgets\MenuItem('Travel', '#'),
            new \App\Widgets\MenuItem('Work', '#'),
        ]))
        ->add(new \App\Widgets\MenuItem('Blog Posts', '#0', [
            new \App\Widgets\MenuItem('Video Post', '#'),
            new \App\Widgets\MenuItem('Audio Post', '#'),
            new \App\Widgets\MenuItem('Gallery Post', '#'),
            new \App\Widgets\MenuItem('Standard Post', '#'),
        ]))
        ->add(new \App\Widgets\MenuItem('Styles', 'frontend.home.index'))
        ->add(new \App\Widgets\MenuItem('About', 'frontend.home.index'))
        ->add(new \App\Widgets\MenuItem('Contact', 'frontend.home.index'))
        ->build()
!!}

