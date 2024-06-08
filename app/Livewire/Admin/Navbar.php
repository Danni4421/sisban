<?php

namespace App\Livewire\Admin;

use App\Livewire\Rt\Notification as RTNotification;
use App\Livewire\Rw\Notification as RwNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user;
    public $notification_element_user_level;

    public function mount()
    {
        $this->user = Auth::user();
        $this->notification_element_user_level = $this->user->level;
    }

    public function render()
    {
        return view('livewire.admin.navbar');
    }
}
