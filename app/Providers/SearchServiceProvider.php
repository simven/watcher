<?php

namespace App\Providers;

use App\Search\Search;
use App\Serie;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('search', function () {
            return new Search(new Serie());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
