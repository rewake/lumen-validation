<?php

namespace Rewake\Lumen\Providers;


use Illuminate\Support\ServiceProvider;
use Rewake\Lumen\Services\ValidationService;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Defer loading
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return ValidationService
     */
    public function register()
    {
        // Get Validation Factory
        $app_validator = app('validator');

        // Override app validator alias
        $this->app->extend('validator', function() use ($app_validator) {

            // Return ValidatorService
            return new ValidationService($app_validator);
        });
    }
}