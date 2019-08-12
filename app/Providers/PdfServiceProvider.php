<?php

namespace App\Providers;

use App\Services\FileGenerators\Pdf;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class PdfServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Pdf::class, static function ($app) {
            return new Pdf($app['config']['pdf']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Pdf::class];
    }
}
