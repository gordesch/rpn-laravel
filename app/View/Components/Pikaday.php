<?php

namespace App\View\Components;

use Illuminate\View\View;

class Pikaday extends \BladeUIKit\Components\Forms\Inputs\Pikaday
{
    public function options(): array
    {
        return array_merge([
            'firstDay' => 1,
            'showWeekNumber' => true,
            'i18n' => [
                'previousMonth' => 'Mois précédent',
                'nextMonth'     => 'Mois suivant',
                'months'        => [
                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre',
                    'Novembre', 'Décembre',
                ],
                'weekdays'      => ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                'weekdaysShort' => ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            ],
        ]);
    }

    public function render():View
    {
        print($this->options());
    }
}
