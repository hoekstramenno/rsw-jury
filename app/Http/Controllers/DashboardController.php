<?php

namespace App\Http\Controllers;

use App\Models\Year;

class DashboardController
{
    public function index($yearLabel)
    {
        $year = Year::where('label', $yearLabel)->first();
        return view('pages.dashboard', [
            'year' => $year
        ]);
    }
}
