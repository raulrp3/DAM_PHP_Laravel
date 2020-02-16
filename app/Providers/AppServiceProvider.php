<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\UserFieldsComposer;
use App\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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

        Builder::macro('whereQuery', function($subquery, $operator, $value = null){
            $this->addBinding($subquery->getBindings());
            $this->where(DB::raw("({$subquery->toSql()})"), $operator, $value);
        });

        Builder::macro('onlyTrashedIf', function($value){
            if($value){
                $this->onlyTrashed();
            }

            return $this;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Sortable::class, function($app){
            return new Sortable(request()->url());
        });
    }
}
