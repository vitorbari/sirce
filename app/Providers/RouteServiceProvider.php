<?php namespace Sirce\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Sirce\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

        // Global Patterns
        $router->pattern('id', '[0-9]+');

        // route model binding
        $router->model('boards',        		'Sirce\Models\Board');
        $router->model('components',    		'Sirce\Models\Component');
        $router->model('component_categories',  'Sirce\Models\ComponentCategory');
        $router->model('manufacturers', 		'Sirce\Models\Manufacturer');
        $router->model('mcus',          		'Sirce\Models\Mcu');
        $router->model('sketches',    			'Sirce\Models\Reference');
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
