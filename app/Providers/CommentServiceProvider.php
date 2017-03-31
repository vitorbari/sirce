<?php namespace Sirce\Providers;

use \View;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{

    protected $routes_comments_section = [

    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
//        dd($router->getCurrentRoute());
//        View::share('comments_section', 1);
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
