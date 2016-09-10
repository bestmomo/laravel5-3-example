<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['back.users.create', 'back.users.edit'], 
            function ($view) {
                $view->with(resolve('App\Repositories\RoleRepository')->allSelect());
            }
        );

        view()->composer(
            ['back.blog.create', 'back.blog.edit', 'back.blog.index', 'back.filemanager', 'back.notifications.index'], 
            function ($view) {
                $view->with(['notifications' => session('statut') == 'redac' && !auth()->user()->unreadNotifications->isEmpty()]);
            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
