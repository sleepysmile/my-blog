<?php


namespace App\Providers;


use App\Models\Publication;
use App\Models\Tags;
use App\Observers\PublicationObserver;
use App\Observers\TagsObserver;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Tags::observe(TagsObserver::class);
        Publication::observe(PublicationObserver::class);
    }
}
