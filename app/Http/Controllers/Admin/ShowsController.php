<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosterForm;
use App\Http\Requests\ShowForm;
use App\Http\Requests\VideoForm;
use App\Show;
use App\Video;
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
        $show = new Show;
        return view('admin.shows.create', compact('show'));
    }

    public function store(ShowForm $show, PosterForm $poster, VideoForm $video): RedirectResponse
    {
        $show = $show->persist();
        flash("{$show->title} a bien été créé")->success();

        // poster
        if (request('poster_url')) {
            $new_poster = [
                'type' => 'url',
                'location' => request('poster_url'),
            ];
            $poster->persist($new_poster, $show);
        }

        // videos
        if (request('video-dubbed')) {
            $video->persist(new Video, $show, false);
        }
        if (request('video-original')) {
            $video->persist(new Video, $show, true);
        }

        return redirect()->route('admin.shows.index');
    }

    public function edit(Show $show): View
    {
        return view('admin.shows.edit', compact('show'));
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
        } catch (\Exception $e) {
            flash('Erreur lors de la suppression')->danger();
        }

        return redirect()->route('admin.shows.index');
    }
}
