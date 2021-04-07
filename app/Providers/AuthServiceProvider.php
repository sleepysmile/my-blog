<?php

namespace App\Providers;

use App\Models\Publication;
use App\Policies\PublicationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Publication::class => PublicationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-publication', 'App\Policies\PublicationPolicy@edit');
        Gate::define('update-publication', 'App\Policies\PublicationPolicy@update');
        Gate::define('delete-publication', 'App\Policies\PublicationPolicy@delete');
    }
}
