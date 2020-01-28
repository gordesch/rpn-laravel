<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\ShowsProviderInterface;
use GuzzleHttp\Exception\GuzzleException;

class ShowsImportSearchController extends Controller
{

    public function create()
    {
        return view('admin.shows.import.search.create');
    }

    public function show(ShowsProviderInterface $showsProvider)
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
