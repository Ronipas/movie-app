<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

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
        // Share favorite count ke semua view
    View::composer('*', function ($view) {
        $count = 0;
        if (Auth::check()) {
            $count = Favorite::where('user_id', Auth::id())->count();
        }
        $view->with('favoriteCount', $count);
    });
    }
}
