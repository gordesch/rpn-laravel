<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Week;
use Illuminate\View\View;

class ShowingsController extends Controller
{
    public function index(Week $week): View
    {
        return view('admin.weeks.showings.index', compact('week'));
    }
}
