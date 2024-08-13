<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class FirebaseUserProvider extends ServiceProvider
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
        // Share the currently authenticated user across all views
        view()->composer('*', function ($view) {
            $user = null;
            $uid = session('uid');

            if ($uid) {
                // Use caching to reduce the number of requests to Firebase
                $cacheKey = 'firebase_user_' . $uid;
                $user = Cache::remember($cacheKey, 60, function () use ($uid) {
                    return Firebase::database()->getReference('users/' . $uid)->getValue();
                });
            }

            $view->with('authUser', $user);
        });
    }
}
