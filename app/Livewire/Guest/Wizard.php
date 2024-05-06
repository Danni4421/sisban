<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Wizard extends Component
{
    private $formIndex;

    public function mount($formIndex)
    {
        $this->formIndex = $formIndex;
    }

    public function render()
    {
        return view('livewire.guest.wizard')
            ->with('formIndex', $this->formIndex);
    }
}
