<?php

namespace App\Livewire;

use Livewire\Component;

class TimeEntry extends Component
{
    public $isLogged;

    public function save()
    {
        $this->isLogged = !$this->isLogged;
    }

    public function mount()
    {
        $this->isLogged = true;
    }

    public function render()
    {
        return view('livewire.time-entry');
    }
}
