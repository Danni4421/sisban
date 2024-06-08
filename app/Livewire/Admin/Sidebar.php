<?php
namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\HasSidebarItem;
use Illuminate\Routing\Route;
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

            if (is_null($this->activeItem)) {
                switch ($this->level) {
                    case "rt" || "rw":
                        $this->activeItem = '/';

                        break;
                    case "admin":
                        $this->activeItem = "/data-rw";
                        break;
                    default:
                        $this->activeItem = null;
                }
            }

            $this->init(level: $this->level);
        }
    }

    public function updateActiveItem($selectedActiveItem, $withLevel = false)
    {   
        $this->activeItem = $selectedActiveItem;

        session()->put('activeSidebarItem', $selectedActiveItem);

        return redirect()->to($withLevel ? $this->level . $selectedActiveItem : $selectedActiveItem);
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->to('/login');
    }

    public function render()
    {
        return view('livewire.admin.sidebar');
    }
}