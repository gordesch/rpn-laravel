<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageFormRequest;
use App\Jobs\Admin\Website\StorePageJob;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class PagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.website.pages.create');
    }

    public function store(PageFormRequest $request)
    {
        StorePageJob::dispatchNow(collect($request->all()));
    }
}
