<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Map extends Component
{
    /**
     * @var double
     */
    private $lat, $long;
    
    /**
     * @var int
     */
    private $zoomLevel;

    public function __construct()
    {
        $this->lat = -7.9224435;
        $this->long = 112.6065386;
        $this->zoomLevel = 15;
    }

    public function render()
    {
        return view('livewire.guest.map')
            ->with('lat', $this->lat)
            ->with('long', $this->long)
            ->with('zoomLevel', $this->zoomLevel);
    }
}
