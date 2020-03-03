<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function change(Request $request, string $year)
    {
        $request->session()->put('currentYear', $year);

        $request->session()->flash('status', 'Jaar ' . $year . 'geselecteerd');

        return redirect()->route('dashboard', ['year' => $year]);
    }
}
