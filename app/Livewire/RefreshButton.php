<?php

namespace App\Livewire;

use Livewire\Component;

class RefreshButton extends Component
{
    public function refresh()
    {
        $this->dispatch('refreshData');
    }

    public function render()
    {
        return view('livewire.refresh-button');
    }
}
