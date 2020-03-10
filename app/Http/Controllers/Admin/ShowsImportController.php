<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\ShowsProviderInterface;
use App\Services\VideosProvider\VideosProviderInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowsImportController extends Controller
{
    /**
     * Displays the form for checking import infos
     *
     * @return RedirectResponse|View
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(
        ShowsProviderInterface $showsProvider,
        VideosProviderInterface $videosProvider
    ) {
        $code = request('code');

        try {
            $show = $showsProvider::show($code);
            $show->ticketing_provider_id = request('ticketing_provider_id');
        } catch (GuzzleException $e) {
            flash('Erreur lors de la connexion à Allociné. Veuillez réessayer.')->danger();
            return redirect()->back();
        }

        try {
            $videos = $videosProvider::search($show);
        } catch (GuzzleException $e) {
            flash('Erreur lors de la connexion à Allociné. Veuillez réessayer.')->danger();
            return redirect()->back();
        }

        return view('admin.shows.import.create', compact('show', 'videos'));
    }
}
