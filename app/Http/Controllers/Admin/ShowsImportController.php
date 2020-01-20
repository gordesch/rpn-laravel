<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Show;
use App\Wrappers\Allocine\Allocine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SimpleXMLElement;

class ShowsImportController extends Controller
{
    /**
     * Displays the form for checking import infos
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create()
    {
        $code = request('code');
        $show = Allocine::movie($code);
        //ddd($show);
        //$show = Allocine::movie($code);
        return view('admin.shows.import.create', compact('show'));
    }
}
