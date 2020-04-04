<?php

namespace App\Http\Livewire\Admin\Showings;

use App\Show;
use App\Showing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $week_id = null;
    public $show_id = null;
    public $date = null;
    public $time = null;

    public function mount($week): void
    {
        $this->week_id = $week->id;
    }

    public function updatedWeekId($week_id)
    {
        $this->show_id = $this->date = $this->time = null;
    }

    public function updatedShowId($show_id)
    {
        $this->date = $this->time = null;
    }

    public function updatedDate($date)
    {
        $this->time = null;
    }

    public function render(): View
    {
        $week_id = $this->week_id;
        $show_id = $this->show_id;
        $date = $this->date;
        $time = $this->time;

        $showings = Showing::with('programming.show')
            ->orderBy('datetime')
            ->when($week_id, function (EloquentBuilder $query, $week_id) {
                return $query->whereHas(
                    'programming.week',
                    function (EloquentBuilder $query) use ($week_id) {
                        return $query->where('id', $week_id);
                    }
                );
            })->when($show_id, function (EloquentBuilder $query, $show_id) {
                return $query->whereHas(
                    'programming.show',
                    function (EloquentBuilder $query) use ($show_id) {
                        return $query->where('id', $show_id);
                    }
                );
            })->when($date, function (EloquentBuilder $query, $date) {
                return $query->whereDate('datetime', Carbon::parse($date));
            })->when($time, function (EloquentBuilder $query, $time) {
                return $query->whereRaw(
                    'TIME_FORMAT(datetime, "%H:%i:00") = ?', $time
                );
            })->paginate($this->perPage);

        $times
            = Showing::selectRaw(
                'distinct TIME_FORMAT(datetime, "%H:%i:00") AS time'
            )->orderBy('time', 'asc')
            ->when($week_id, function (EloquentBuilder $query, $week_id) {
                return $query->whereHas(
                    'programming.week',
                    function (EloquentBuilder $query) use ($week_id) {
                        return $query->where('id', $week_id);
                    }
                );
            })->when($show_id, function (EloquentBuilder $query, $show_id) {
                return $query->whereHas(
                    'programming.show',
                    function(EloquentBuilder $query) use ($show_id) {
                        return $query->where('id', $show_id);
                    }
                );
            })->when($date, function (EloquentBuilder $query, $date) {
                return $query->whereDate('datetime', Carbon::parse($date));
            })->get()
            ->pluck('time')
            ->transform(function ($time) {
                return Carbon::parse($time);
            });

        $dates = Showing::selectRaw(
            'distinct DATE(datetime) as date'
        )->orderBy('date', 'asc')
            ->when($week_id, function (EloquentBuilder $query, $week_id) {
                return $query->whereHas(
                    'programming.week',
                    function (EloquentBuilder $query) use ($week_id) {
                        return $query->where('id', $week_id);
                    }
                );
            })->when($show_id, function (EloquentBuilder $query, $show_id) {
                return $query->whereHas(
                    'programming.show',
                    function(EloquentBuilder $query) use ($show_id) {
                        return $query->where('id', $show_id);
                    }
                );
            })->get()
            ->pluck('date')
            ->transform(function ($date) {
                return Carbon::parse($date);
            });

        $shows = Show::select(['id', 'title'])
            ->distinct()
            ->when($week_id, function (EloquentBuilder $query, $week_id) {
                return $query->whereHas(
                    'programmings.week',
                    function (EloquentBuilder $query) use ($week_id) {
                        return $query->where('id', $week_id);
                    }
                );
            })->get();

        return view('livewire.admin.showings.table', [
            'showings' => $showings,
            'shows' => $shows,
            'dates' => $dates,
            'times' => $times,
        ]);
    }
}
