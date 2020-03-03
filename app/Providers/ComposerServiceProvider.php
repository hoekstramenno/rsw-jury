<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\YearsComposer;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        view()->composer(
            '*',
            YearsComposer::class
        );
    }
}
