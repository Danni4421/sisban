<?php

namespace App\Livewire\Guest;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    /**
     * @var array<object, object>
     */
    public $NAVIGATION_ITEMS;

    /** @var string */
    public $ACTIVE_ITEM;

    public $is_user_authed = false;
    public $user = null;

    public function __construct()
    {
        if (Auth::check()) {
            $this->is_user_authed = true;
            $this->user = Auth::user()->warga;
        }

        $this->NAVIGATION_ITEMS = (object) [
            'beranda' => (object) [
                'label' => 'Beranda',
                'href' => '/',
                'active' => 'beranda',
                'on_user_logged_in' => 'd-inline'
            ],
            'jenis' => (object) [
                'label' => 'Jenis',
                'href' => '/#jenis-bansos',
                'active' => 'jenis',
                'on_user_logged_in' => 'd-inline'
            ],
            'panduan' => (object) [
                'label' => 'Panduan',
                'href' => '/#panduan-pengajuan',
                'active' => 'panduan',
                'on_user_logged_in' => 'd-inline'
            ],
            'pengajuan' => (object) [
                'label' => 'Pengajuan',
                'href' => '/pengajuan',
                'active' => 'pengajuan',
                'on_user_logged_in' => 'd-inline'
            ],
            'denah' => (object) [
                'label' => 'Denah',
                'href' => '/#denah',
                'active' => 'denah',
                'on_user_logged_in' => 'd-inline'
            ],
            'informasi' => (object) [
                'label' => 'Informasi',
                'href' => '/informasi',
                'active' => 'informasi',
                'on_user_logged_in' => 'd-inline',
                'children' => (object) [
                    'pemohon' => (object) [
                        'label' => 'Pemohon',
                        'href' => '/informasi/pemohon',
                        'active' => 'informasi',
                        'on_user_logged_in' => 'd-inline'
                    ],
                    'penerima' => (object) [
                        'label' => 'Penerima',
                        'href' => '/informasi/penerima',
                        'active' => 'informasi',
                        'on_user_logged_in' => 'd-inline'
                    ],
                ]
            ],
            'pengurus' => (object) [
                'label' => 'Login',
                'href' => '/login',
                'active' => 'login',
                'on_user_logged_in' => 'd-none'
            ]
        ];
    }

    public function updateActiveItem($activeItem)
    {
        $this->ACTIVE_ITEM = $activeItem;
    }

    public function render()
    {
        return view('livewire.guest.navbar');
    }
}
