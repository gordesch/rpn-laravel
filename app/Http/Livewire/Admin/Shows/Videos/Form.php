<?php

namespace App\Http\Livewire\Admin\Shows\Videos;

use App\Services\VideosProvider\Youtube\Youtube;
use App\Show;
use Illuminate\Http\Client\RequestException;
use Livewire\Component;

class Form extends Component
{
    public string $showTitle = '';
    public bool $showIsLocalLanguage = false;
    /**
     * @var array<array>
     */
    public array $videos = [
        'dubbed_version' => [],
        'original_version' => [],
    ];

    public function mount(string $showTitle, bool $showIsLocalLanguage): void
    {
        $this->showTitle = $showTitle;
        $this->showIsLocalLanguage = $showIsLocalLanguage;
    }

    public function loadVideos(): void
    {
        try {
            $show = new Show();
            $show->title = $this->showTitle;
            $this->videos = Youtube::search($show)->toArray();
        } catch (RequestException $e) {
            // @TODO handle error
            //flash('Erreur lors de la connexion à Youtube. Veuillez recharger la page.')->error();
            $this->reset('videos');
        }
    }
}
