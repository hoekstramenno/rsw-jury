<?php

namespace App\Http\ViewComposers;

use App\Models\Year;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class YearsComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'availableYears',
            Cache::remember(
                'availableYears',
                3600,
                function () {
                    return Year::all();
                }
            )
        );

        $view->with(
            'currentYear',
            session()->get('currentYear') ?? Cache::get('availableYears')->sortByDesc('label')->first()->label
        );
    }
}
