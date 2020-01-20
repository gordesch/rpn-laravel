<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Wrappers\Allocine\Allocine;

class ShowsImportSearchController extends Controller
{

    public function create()
    {
        return view('admin.shows.import.search.create');
    }

    public function show()
    {
        $title = request('searched_show');
        $shows = Allocine::search($title);

        return view('admin.shows.import.search.show', compact('shows'));
    }

}
