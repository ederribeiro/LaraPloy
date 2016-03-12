<?php

namespace Ederribeiro\Laraploy;

use Illuminate\Support\ServiceProvider;

class LaraployServiceProvider extends ServiceProvider
{
    protected $commands = [
        Commands\DeployCommand::class
    ];
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
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
