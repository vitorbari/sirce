<?php namespace Sirce\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        \Sirce\Models\Component::observe(new \Sirce\Models\Observers\ComponentObserver);
	}

	/**
     * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

}
