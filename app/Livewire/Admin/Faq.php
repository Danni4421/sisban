<?php

namespace App\Livewire\Admin;

use DOMDocument;
use Livewire\Component;

class Faq extends Component
{
    public $tab;
    public $faqs = [];

    public function mount($faqs)
    {
        $this->tab = "ask";
        $this->faqs = $faqs;
    }

    public function updateActiveTab(string $activeTab) 
    {
        $this->tab = $activeTab;
    }

    public function render()
    {
        return view('livewire.admin.faq');
    }
}
