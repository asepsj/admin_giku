<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\View;

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
                // Directly retrieve the user data from Firebase without caching
                $user = Firebase::database()->getReference('users/' . $uid)->getValue();
            }

            $view->with('authUser', $user);
        });
    }
}
