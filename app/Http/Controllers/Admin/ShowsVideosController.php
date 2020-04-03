<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoForm;
use App\Show;
use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowsVideosController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show): View
    {
        return view('admin.shows.videos.edit')->with(['show' => $show]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Show $show, VideoForm $video): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $show->videos()->delete();
            if (request('video-dubbed')) {
                $video->persist(
                    new Video(),
                    $show,
                    false,
                    collect($request->all())
                );
                flash('Bande-annonce VF ajoutée')->success();
            }
            if (request('video-original')) {
                $video->persist(
                    new Video(),
                    $show,
                    true,
                    collect($request->all())
                );
                flash('Bande-annonce VO ajoutée')->success();
            }
            if (! request('video-dubbed') && ! request('video-original')) {
                flash('Bandes-annonces supprimées avec succès')->success();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            flash('Échec de l\'ajout de bande(s)-annonce(s)')->error();
            return redirect()->back();
        }
        return redirect()->route('admin.shows.edit', [$show]);
    }
}
