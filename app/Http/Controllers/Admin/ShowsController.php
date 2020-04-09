<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosterFormRequest;
use App\Http\Requests\ShowFormRequest;
use App\Http\Requests\VideosFormRequest;
use App\Jobs\Admin\Shows\StoreShowJob;
use App\Show;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowsController extends Controller
{
    public function index(): View
    {
        return view('admin.shows.index');
    }

    public function create(): View
    {
        return view('admin.shows.create')->with(['show' => new Show()]);
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(ShowFormRequest $request): RedirectResponse
    {
        app()->make(PosterFormRequest::class);
        app()->make(VideosFormRequest::class);
        StoreShowJob::dispatchNow(collect($request->all()));
        return redirect()->route('admin.shows.index');
    }

    public function edit(Show $show): View
    {
        return view('admin.shows.edit')->with(['show' => $show]);
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(
        Show $show,
        ShowFormRequest $request
    ): RedirectResponse {
        app()->make(PosterFormRequest::class);
        StoreShowJob::dispatchNow(collect($request->all()), $show);
        return redirect()->route('admin.shows.index');
    }

    public function destroy(Show $show): RedirectResponse
    {
        try {
            $show->delete();
            flash("{$show->title} a bien été supprimé")->success();
        } catch (\Exception $exception) {
            flash('Erreur lors de la suppression')->error();
        }

        return redirect()->route('admin.shows.index');
    }
}
