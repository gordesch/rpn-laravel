<?php

namespace App\Http\Livewire\Admin\Shows\Videos;

use App\Services\VideosProvider\VideosProviderInterface;
use App\Show;
use Illuminate\Http\Client\RequestException;
use Livewire\Component;

class Form extends Component
{
    public string $showTitle = '';
    public bool $showIsLocalLanguage = false;
    public $videos = [
        'dubbed_version' => [],
        'original_version' => [],
    ];

    public function mount($showTitle, $showIsLocalLanguage)
    {
        $this->showTitle = (string) $showTitle;
        $this->showIsLocalLanguage = (bool) $showIsLocalLanguage;
    }

    public function loadVideos(VideosProviderInterface $videosProvider)
    {
        try {
            $show = new Show;
            $show->title = $this->showTitle;
            $this->videos = $videosProvider::search($show)->toArray();
        } catch (RequestException $e) {
            //flash('Erreur lors de la connexion à Youtube. Veuillez recharger la page.')->danger();
            $this->reset('videos');
        }
    }
}

