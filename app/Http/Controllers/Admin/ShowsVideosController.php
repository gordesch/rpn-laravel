<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoForm;
use App\Providers\VideosServiceProvider;
use App\Services\VideosProvider\VideosProviderInterface;
use App\Show;
use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowsVideosController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Show $show, VideosProviderInterface $videosProvider): View
    {
        return view('admin.shows.videos.edit', compact ('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Show $show, VideoForm $video): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $show->videos()->delete();
            if (request('video-dubbed')) {
                $video->persist(new Video, $show, false);
                flash('Bande-annonce VF ajoutée')->success();
            }
            if (request('video-original')) {
                $video->persist(new Video, $show, true);
                flash('Bande-annonce VO ajoutée')->success();
            }
            if (!request('video-dubbed') && !request('video-original')) {
                flash('Bandes-annonces supprimées avec succès')->success();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash('Échec de l\'ajout de bande(s)-annonce(s)')->error();
        }

        return redirect()->back();
    }
}
