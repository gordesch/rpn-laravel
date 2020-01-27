<?php

namespace App\Http\Controllers\Admin;

use Alaouy\Youtube\Facades\Youtube;
use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\ShowsProviderInterface;
use App\Services\VideosProvider\VideosProviderInterface;

class ShowsImportController extends Controller
{
    /**
     * Displays the form for checking import infos
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(
        ShowsProviderInterface $showsProvider,
        VideosProviderInterface $videosProvider
    ) {
        $code = request('code');
        $show = $showsProvider::show($code);
        $videos = $videosProvider::search($show);

        return view('admin.shows.import.create', compact('show', 'videos'));
    }
}
