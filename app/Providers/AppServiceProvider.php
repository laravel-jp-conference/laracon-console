<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any laracon-console services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any laracon-console services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->bindMap() as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }

    /**
     * @return array
     */
    private function bindMap(): array
    {
        return [
        ];
    }
}
