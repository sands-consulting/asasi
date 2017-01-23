<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sands\Asasi\Booted\BootedTrait;

class AsasiServiceProvider extends ServiceProvider
{
    use BootedTrait;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBootedTrait();

        $this->app->validator->extend('hash', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        $this->app->validator->extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
    }

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
     * After application bootstrapped.
     *
     * @return void
     */
    public function booted()
    {
        $this->bootedLanguage();
    }

    protected function bootedLanguage()
    {
        $this->app->setLocale(request()->cookie('locale') ?: 'en');
    }
}
