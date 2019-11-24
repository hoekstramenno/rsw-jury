<?php

namespace App\Http\Controllers;

use App\Models\Year;

class DashboardController  extends Controller
{
    public function index($yearLabel)
    {
        return view('pages.dashboard', [
            'year' => Year::where('label', $yearLabel)->first()
        ]);
    }
}
