<?php

namespace Joinapi\DocumentAI;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DocumentAIServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton( 'documentai', function ($app) {
            return new DocumentAIService($app);
        });
    }
}