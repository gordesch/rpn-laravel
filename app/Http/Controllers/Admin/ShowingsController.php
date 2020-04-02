<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Week;
use Illuminate\View\View;

class ShowingsController extends Controller
{
    public function index(Week $week): View
    {
        $week->load('shows_with_missing_data');
        return view('admin.weeks.details.showings', compact('week'));
    }
}
