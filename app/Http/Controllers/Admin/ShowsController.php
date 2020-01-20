<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowForm;
use App\Show;

class ShowsController extends Controller
{
    public function index()
    {
        $shows = Show::all();
        return view('admin.shows.index', compact('shows'));
    }

    public function create()
    {
        return view('admin.shows.create');
    }

    public function store(ShowForm $form)
    {
        $form->persist(new Show);
        return redirect()->route('admin.shows.index');
    }

    public function edit(Show $show)
    {
        return view('admin.shows.edit', compact('show'));
    }

    public function update(ShowForm $form, Show $show)
    {
        $form->update($show);

        return redirect()->route('admin.shows.index');
    }

    public function destroy(Show $show)
    {
        $show->delete();

        return redirect();
    }
}
