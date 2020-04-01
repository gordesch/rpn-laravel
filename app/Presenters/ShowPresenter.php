<?php

namespace App\Presenters;

trait ShowPresenter
{
    public function getAudienceShortStringAttribute(): ?string
    {
        if ($this->audience === null) {
            return null;
        }
        if ($this->audience == 18 || $this->audience == 16 || $this->audience == 12) {
            return "-{$this->audience}";
        }
        if ($this->audience == 0) {
            return 'Avert.';
        }
        if ($this->audience && ($this->audience < 12)) {
            return "Conseillé à partir de {$this->audience} ans";
        }

        return null;
    }

    public function getAudienceLongStringAttribute(): ?string
    {
        if (! $this->audience) {
            return null;
        }
        if ($this->audience == 18) {
            return 'Interdit aux moins de dix-huit ans';
        }
        if ($this->audience == 16) {
            return 'Interdit aux moins de seize ans';
        }
        if ($this->audience == 12) {
            return 'Interdit aux moins de douze ans';
        }
        if ($this->audience == 0) {
            return 'Avertissement : des scènes peuvent choquer la sensibilité des plus sensibles';
        }
        if ($this->audience && ($this->audience < 12)) {
            return "Conseillé à partir de {$this->audience} ans";
        }

        return null;
    }

    public function getCastStringAttribute(): ?string
    {
        if (! $this->cast) {
            return null;
        }
        return "Avec {$this->cast}";
    }

    public function getGenreDirectorCountryYearStringAttribute(): ?string
    {
        if (! $this->genre && ! $this->director && ! $this->country && ! $this->year && ! $this->year) {
            return null;
        }
        $genre_director = '';
        if ($this->genre) {
            $genre_director .= ucfirst($this->genre);
        }
        if ($this->genre && $this->director) {
            $genre_director .= ' de ';
        } else {
            $genre_director .= 'De ';
        }
        if ($this->director) {
            $genre_director .= $this->director;
        }
        $duration
            = $this->duration_in_seconds
            ? $this->duration->format('%hh%I')
            : null;
        $details = array_filter([
            $genre_director,
            $duration,
            $this->country,
            $this->year,
        ]);
        return implode(' – ', $details);
    }
}
