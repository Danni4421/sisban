<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\HasSidebarItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    use HasSidebarItem;

    /**
     * @var string
     */
    public $brand = 'Sisban';

    /**
     * @var User
     */
    public $user = null;

    /**
     * @var string
     */
    public $level = null;

    /**
     * @var ?string 
     */
    public $activeItem = null;

    public function __construct()
    {
        if (Auth::check()) {
            $this->user = auth()->user();
            $this->level = $this->user->level;

            if (session()->has('activeSidebarItem')) {
                $this->activeItem = session()->get('activeSidebarItem');
            }

            $this->activeItem = Route::current()->getName();
            $this->init(level: $this->level);
        }
    }

    public function updateActiveItem($selectedActiveItem, $withLevel = false)
    {
        // $this->activeItem = $selectedActiveItem;

        // session()->put('activeSidebarItem', $selectedActiveItem);

        return redirect()->to($withLevel ? $this->level . $selectedActiveItem : $selectedActiveItem);
    }

    public function render()
    {
        return view('livewire.admin.sidebar');
    }
}
