<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class IndexButton extends Component
{
    public function loadScout(): void
    {
        $this->dispatch('reIndexScout');
    }

    public function render(): View
    {
        return view('livewire.index-button');
    }
}
