<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\ShowsProviderInterface;
use App\Services\VideosProvider\VideosProviderInterface;
use Illuminate\View\View;

class ShowsImportController extends Controller
{
    /**
     * Displays the form for checking import infos
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(
        ShowsProviderInterface $showsProvider,
        VideosProviderInterface $videosProvider
    ): View {
        $code = request('code');

        $show = $showsProvider::show($code);
        $show->ticketing_provider_id = request('ticketing_provider_id');

        $videos = $videosProvider::search($show);

        return view('admin.shows.import.create', compact('show', 'videos'));
    }
}
