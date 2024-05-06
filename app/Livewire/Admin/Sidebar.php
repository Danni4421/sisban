<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\HasSidebarItem;
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
    private $user = null;

    /**
     * @var string
     */
    public $level = null;

    /** @var string */
    public $activeItem = null;

    /**
     * Menu untuk role RT
     * 
     * @var array<object, object>
     */
    public $NAVIGATION_RT;

    /**
     * Menu untuk role RW
     * 
     * @var array<object, object>
     */
    public $NAVIGATION_RW;

    /**
     * Menu untuk role Admin
     * 
     * @var array<object, object>
     */
    public $NAVIGATION_ADMIN;

    public function __construct()
    {
        if (!is_null(auth()->user())) {
            $this->user = auth()->user();
            $this->level = $this->user->level;

            $this->activeItem = $this->level == 'admin' ? '/data-rw' : '/';

            if (session()->has('activeSidebarItem')) {
                $this->activeItem = session()->get('activeSidebarItem');
            }

            $this->init();
        }
    }

    public function updateActiveItem(string $item, bool $withLevel = false)
    {
        $this->activeItem = $item;

        session()->put('activeSidebarItem', $this->activeItem);

        return redirect()->to($withLevel ? $this->level . $item : $item);
    }

    public function render()
    {
        return view('livewire.admin.sidebar')->with([
            'data' => $this->level === 'rt' ? $this->NAVIGATION_RT : ($this->level === 'rw' ? $this->NAVIGATION_RW : $this->NAVIGATION_ADMIN)
        ]);
    }
}
