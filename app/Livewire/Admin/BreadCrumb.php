<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class BreadCrumb extends Component
{
    public array $links;
    public $active;

    public function mount(array $links = [], string $active)
    {
        $this->links = $links;
        $this->active = $active;
    }

    public function render()
    {
        return view('livewire.admin.bread-crumb');
    }
}
