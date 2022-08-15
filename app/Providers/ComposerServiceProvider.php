<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$categories = Category::all(['name', 'slug']);

        //compartilhamento das categorias entre todas as views
        //view()->share('categories', $categories);

        //compartilhamento das categorias entre views especificas
        /*
        view()->composer(['welcome', 'single'], function ($view) {
            $view->with('categories', []);
        });

        view()->composer('*', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });
        */

        //compartilhar com todas as views o metodo compose
        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
