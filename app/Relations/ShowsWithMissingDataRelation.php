<?php

namespace App\Relations;
use Illuminate\Database\Eloquent\Builder;
use App\Show;
use App\Week;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class ShowsWithMissingDataRelation extends Relation
{
    /** @var Show|Builder */
    protected $query;

    /** @var Week */
    protected $parent;

    public function __construct(Week $parent)
    {
        parent::__construct(Show::query(), $parent);
    }

    public function addConstraints()
    {
        $this
            ->query
            ->orWhereNull([
                'genre',
                'duration_in_seconds',
                'country',
                'year',
                'director',
                'cast',
                'synopsis'
            ])
            ->orDoesntHave('videos')
            ->join(
                'programmings',
                'show_id',
                '=',
                'shows.id'
            )->toSql();
    }

    public function addEagerConstraints(array $weeks)
    {
        $this
            ->query
            ->with('programmings')
            ->whereIn(
                'programmings.week_id',
                collect($weeks)->pluck('id')
            )
            ->select('shows.*');
    }

    public function initRelation(array $weeks, $relation)
    {
        foreach ($weeks as $week) {
            $week->setRelation(
                $relation,
                $this->related->newCollection()
            );
        }

        return $weeks;
    }

    public function match(array $weeks, Collection $shows, $relation)
    {
        if ($shows->isEmpty()) {
            return $weeks;
        }

        foreach ($weeks as $week) {
            $week->setRelation(
                $relation,
                $shows->filter(function (Show $show) use ($week) {
                    return $show->programmings->pluck('week_id')->contains($week->id);
                })
            );
        }

        return $weeks;
    }

    public function getResults()
    {
        return $this->query->get();
    }
}
