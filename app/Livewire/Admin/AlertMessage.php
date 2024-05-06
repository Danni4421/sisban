<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AlertMessage extends Component
{
    public $class, $label, $message;

    public function mount($class, $message) 
    {
        switch ($class) {
            case "success":
                $this->label = "Berhasil";
            case "warning":
                $this->label = "Peringatan";
            case "danger":
                $this->label = "Error";
            default:
                $this->label = "Informasi";
        }    
        $this->class = $class;
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.admin.alert-message')
            ->with('label', $this->label)
            ->with('class', $this->class)
            ->with('message', $this->message);
    }
}
