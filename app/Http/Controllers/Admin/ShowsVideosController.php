<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Shows\StoreVideos;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoForm;
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
     */
    public function edit(Show $show): View
    {
        return view('admin.shows.videos.edit')->with(['show' => $show]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Throwable
     */
    public function update(
        Request $request,
        Show $show,
        StoreVideos $store_videos
    ): RedirectResponse{
        DB::beginTransaction();
        try {
            $show->videos()->delete();
            $store_videos->execute($show, collect($request->all()));
            if (
                 is_null($request->get('video-dubbed'))
                && is_null($request->get('video-original'))
            ) {
                flash('Bandes-annonces supprimées avec succès')->success();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
        return redirect()->route('admin.shows.edit', [$show]);
    }
}
