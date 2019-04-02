<?php
/**
 * Created by PhpStorm.
 * User: xiaomo
 * Date: 2019/4/2
 * Time: 10:43 AM
 */

namespace Xiaowas\Nopasspay;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        // this for conig
        $this->publishes([
            __DIR__ . '/config/nopasspay.php' => config_path('nopasspay.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('nopasspay', function ($app) {
            return new Nopasspay();
        });
    }
}