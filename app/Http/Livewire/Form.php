<?php

namespace App\Http\Livewire;

use App\Services\VideosProvider\VideosProviderInterface;
use App\Show;
use Illuminate\Http\Client\RequestException;
use Livewire\Component;

class Form extends Component
{
    public $show;
    public $showTitle;
    public $showIsLocalLanguage;
    public $videos = [
        'dubbed_version' => [],
        'original_version' => [],
    ];

    public function mount($showTitle, $showIsLocalLanguage)
    {
        $this->show = new Show;
        $this->show->title = $showTitle;
        $this->show->is_local_language = $showIsLocalLanguage;
        $this->showTitle = $showTitle;
        $this->showIsLocalLanguage = $showIsLocalLanguage;
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


    public function render()
    {
        return view('livewire.admin.shows.videos.form');
    }
}
