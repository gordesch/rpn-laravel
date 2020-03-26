<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        return view('admin.website.pages.create');
    }

    public function store(Request $request)
    {
        ddd(request('content'));
    }
}
