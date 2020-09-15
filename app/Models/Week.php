<?php

namespace App\Models;

use App\Models\Programming;
use App\Models\Showing;
use App\Relations\ShowsWithMissingDataRelation;
use Carbon\CarbonPeriod;
use Gordesch\CineCarbon;
use Gordesch\CineCarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Week extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'number',
        'start',
        'end',
    ];

    /**
     * The attributes that should be cast to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
    ];

    public function setNumberAttribute(string $iso_week_number): void
    {
        $this->attributes['number'] = $iso_week_number;
        $week = CineCarbonImmutable::createFromProgrammingWeek($iso_week_number);
        $this->attributes['start'] = $week->startOfWeek();
        $this->attributes['end'] = $week->endOfWeek();
    }

    public function getDaysAttribute(): CarbonPeriod
    {
        return CarbonPeriod::between($this->start, $this->end)->setDateClass(CineCarbon::class);
    }

    public function getAsStringAttribute(): string
    {
        return $this->start->month === $this->end->month
            ? "Du {$this->start->isoFormat('dddd DD')} au {$this->end->isoFormat('dddd DD MMMM YYYY')}"
            : "Du {$this->start->isoFormat('dddd DD MMMM')} au {$this->end->isoFormat('dddd DD MMMM YYYY')}";
    }

    public function getIsAdjustedAttribute(): bool
    {
        return ! $this->programmings->contains('is_adjusted', false);
    }

    public function programmings(): Relation
    {
        return $this->hasMany(Programming::class);
    }

    public function showings(): Relation
    {
        return $this->hasManyThrough(Showing::class, Programming::class);
    }

    public function shows_with_missing_data(): ShowsWithMissingDataRelation
    {
        return new ShowsWithMissingDataRelation($this);
    }
}
