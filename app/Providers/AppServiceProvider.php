<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Client;
use App\Fabricator;
use App\Product;
use App\Service;

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

        // run view_composer_all
        $this->view_composer_all();
    }

    /**
     * view_composer_all
     *
     * @return extienda data a las vistas
     */
    public function view_composer_all()
    {
        view()->composer('*', function ($view) {
            $view->with('user_count', User::count());
            $view->with('client_count', Client::count());
            $view->with('fabricator_count', Fabricator::count());
            $view->with('product_count', Product::count());
            $view->with('service_count', Service::count());
        });
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
