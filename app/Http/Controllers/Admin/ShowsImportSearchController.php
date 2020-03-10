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

    public function show(ShowsProviderInterface $showsProvider): View
    {
        $title = request('searched_show');
        $ticketing_provider_id = request('ticketing_provider_id');
        try {
            $shows = $showsProvider::search($title);
        } catch (GuzzleException $e) {
            flash("Erreur lors de la recherche, veuillez réessayer")->error();
        }

        return view('admin.shows.import.search.show', compact('shows', 'ticketing_provider_id'));
    }

}
