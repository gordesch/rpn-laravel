<?php

namespace App\Actions;

use App\Wrappers\EMS\EMS;
use Illuminate\Support\Collection;

class PrepareForShowingsImport
{
    protected Collection $showsWithShowings;

    public function __construct()
    {
    }

    public function handle()
    {
        $this->getShowsWithShowings();
        $this->storeShowsWithShowings();
    }

    private function getShowsWithShowings() {
        $this->showsWithShowings = EMS::showingsByShow();
    }

    private function storeShowsWithShowings()
    {
        session(['shows_to_import' => $this->showsWithShowings]);
    }

    public function getShowsForMatching()
    {

    }
}
