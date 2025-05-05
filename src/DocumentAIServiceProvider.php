<?php

namespace Joinapi\DocumentAI;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DocumentAIServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {

        $this->app->singleton( 'documentai', function ($app) {
            $config = $app->make('config')->get('documentai', []);
            return new DocumentAIService($config);
        });
    }
    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/documentai.php', 'documentai');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/documentai.php' => $this->app->configPath('documentai.php'),
            ], 'documentai-config');
        }
    }
}