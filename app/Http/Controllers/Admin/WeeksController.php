<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Week;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WeeksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Week $week): View
    {
        $week->load([
            'programmings' => function ($query) {
                $query
                    ->withCount('showings')
                    ->orderBy('order', 'asc')
                    ->orderBy('showings_count', 'desc');
            },
            'programmings.show',
        ]);

        return view('admin.weeks.show', compact('week'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function edit(Week $week)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Week $week)
    {
        ddd(request('programming'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function destroy(Week $week)
    {
        //
    }
}
