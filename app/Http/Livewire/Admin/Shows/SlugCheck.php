<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Livewire\Component;

class SlugCheck extends Component
{
    public bool $shouldExist;
    public string $name;
    public string $title;
    public ?string $value;
    public string $width;
    public string $state;
    public ?string $ticketingProviderId;

    public function mount(
        bool $shouldExist,
        string $name,
        string $title,
        ?string $value,
        string $width,
        ?string $ticketingProviderId = null
    ) {
        $this->shouldExist = $shouldExist;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->width = $width;
        $this->ticketingProviderId = $ticketingProviderId;
        $this->check();
    }

    public function updatingValue(?string $value): void {
        if ($value == null) {
            $this->value = null;
            return;
        }
        $this->value = $value;
        $this->check();
    }

    public function check(): void
    {
        if ($this->_isValid()) {
            $this->state = 'success';
        } else {
            $this->state = 'error';
        }
    }
    private function _isValid(): bool
    {
        if ($this->shouldExist) {
            return $this->_exists();
        } else {
            return ! $this->_exists();
        }
    }

    private function _exists(): bool
    {
        return Show::whereSlug($this->value)->exists();
    }

    public function render()
    {
        return view('livewire.admin.shows.slug-check');
    }
}
