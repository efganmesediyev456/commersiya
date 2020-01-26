<?php

namespace App\Providers;

use App\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\session()->exists('locales')) {
            $locales = Language::all();
            \session(['locales' => Language::all()]);
        }
        View::composer(['layout', 'login-layout'], function ($view) {
            $view->with('languages', \session('locales'));
        });
        Schema::defaultStringLength(191);
    }
}
