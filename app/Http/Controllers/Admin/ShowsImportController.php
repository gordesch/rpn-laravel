<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShowsProvider\Facade\ShowsProvider;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowsImportController extends Controller
{
    /**
     * Displays the form for checking import infos
     *
     * @return RedirectResponse|View
     *
     */
    public function create(): View
    {
        try {
            $code = request('code');
            $show = ShowsProvider::show($code);
            $show->ticketing_provider_id = request('ticketing_provider_id');
        } catch (RequestException $e) {
            flash('Erreur lors de la connexion à Allociné. Veuillez réessayer.')->danger();
            return redirect()->back();
        }

        return view('admin.shows.import.create', compact('show'));
    }
}
