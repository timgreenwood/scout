<?php

namespace Timgreenwood\Scout\Providers;

use Illuminate\Support\ServiceProvider;
use Timgreenwood\Scout\Commands\PurgeCommand;

class ScoutServiceProvider extends ServiceProvider
{

    /**
     * Register all the things
     */
    public function boot()
    {
        $this->commands([
            PurgeCommand::class
        ]);
    }
}
