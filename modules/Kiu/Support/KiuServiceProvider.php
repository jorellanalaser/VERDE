<?php
namespace Modules\Kiu\Support;

use Illuminate\Support\ServiceProvider;

class KiuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerKiuWS();
    }
    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerKiuWS()
    {
		$this->app->bind('KiuWS', function ($app) {
            return new \Modules\Kiu\KiuWS;
		});
    }
}