<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class DataRt extends Component
{
    public $RTS = [
        '025', '026', '027', '028', '029', '030', '031'
    ];

    public function render()
    {
        return view('livewire.guest.data-rt');
    }
}
