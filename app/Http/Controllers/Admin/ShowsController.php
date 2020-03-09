<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosterForm;
use App\Http\Requests\ShowForm;
use App\Http\Requests\VideoForm;
use App\Show;
use App\Video;

class ShowsController extends Controller
{
    public function index()
    {
        $shows = Show::all()->sortByDesc('created_at');

        return view('admin.shows.index', compact('shows'));
    }

    public function create()
    {
        $show = new Show;
        return view('admin.shows.create', compact('show'));
    }

    public function store(ShowForm $show, PosterForm $poster, VideoForm $video)
    {
        $show = $show->persist(new Show);
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

    public function edit(Show $show)
    {
        return view('admin.shows.edit', compact('show'));
    }

    public function update(ShowForm $form, Show $show)
    {
        $form->update($show);
        flash("{$show->title} a bien été mis à jour")->success();

        return redirect()->route('admin.shows.index');
    }

    public function destroy(Show $show)
    {
        try {
            $show->delete();
            flash("{$show->title} a bien été supprimé")->success();
        } catch (\Exception $e) {
            flash('Erreur lors de la suppression')->danger();
        }


        return redirect('/admin/shows');
    }
}
