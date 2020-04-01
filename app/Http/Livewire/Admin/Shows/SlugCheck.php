<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Illuminate\View\View;
use Livewire\Component;

class SlugCheck extends Component
{
    public ?bool $shouldExist = null;
    public ?string $name = null;
    public ?string $title = null;
    public ?string $value = null;
    public ?string $width = null;
    public ?string $state = null;
    public ?string $ticketingProviderId = null;
    public ?string $except = null;

    public function mount(
        bool $shouldExist,
        string $name,
        string $title,
        ?string $value,
        string $width,
        ?string $ticketingProviderId = null,
        ?string $except = null
    ): void {
        $this->shouldExist = $shouldExist;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->width = $width;
        $this->ticketingProviderId = $ticketingProviderId;
        $this->except = $except;
        $this->check();
    }

    public function updatingValue(?string $value): void
    {
        if ($value == null) {
            $this->value = null;
            return;
        }
        $this->value = $value;
        $this->check();
    }

    public function check(): void
    {
        if (! $this->shouldExist && $this->value === $this->except) {
            $this->state = 'success';
            return;
        }
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
        }
        return ! $this->_exists();
    }

    private function _exists(): bool
    {
        return Show::whereSlug($this->value)->exists();
    }

    public function render(): View
    {
        return view('livewire.admin.shows.slug-check');
    }
}
