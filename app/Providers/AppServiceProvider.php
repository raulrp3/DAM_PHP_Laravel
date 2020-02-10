<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\UserFieldsComposer;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapThree();

        Blade::component('shared._card', 'card');

        View::composer('users/_fields', UserFieldsComposer::class);

        Paginator::defaultView('shared.pagination');
        Paginator::defaultSimpleView('shared.simple-pagination');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
