<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\ShowsProviderInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;

class ShowsImportSearchController extends Controller
{

    public function create(): View
    {
        return view('admin.shows.import.search.create');
    }

}
