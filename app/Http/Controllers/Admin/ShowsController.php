<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Shows\StoreShow;
use App\Actions\Admin\Shows\StoreVideos;
use App\Http\Controllers\Controller;
use App\Http\Requests\PosterForm;
use App\Http\Requests\ShowForm;
use App\Http\Requests\VideoForm;
use App\Integration\Database\Post;
use App\Show;
use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function store(
        Request $request,
        StoreShow $store_show
    ): RedirectResponse {
        app()->make(ShowForm::class);
        app()->make(PosterForm::class);
        app()->make(VideoForm::class);
        $store_show->execute($request);
        return redirect()->route('admin.shows.index');
    }

    public function edit(Show $show): View
    {
        return view('admin.shows.edit')->with(['show' => $show]);
    }

    public function update(Show $show, ShowForm $form): RedirectResponse
    {
        $form->update($show);
        flash("{$show->title} a bien été mis à jour")->success();

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
